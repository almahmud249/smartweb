<?php

namespace App\Repository;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Product;
use App\Models\LocatHub;
use App\CPU\ImageSizeManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repository\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{

    public function index($request, $tab)
    {
        $seller = auth()->user()->id;
        $search = $request['search'];
        $filter = $request['filter'];
        $from = $request['from'];
        $to = $request['to'];
        $paginate = $request['paginate'];
        $key = $request['search'] ? explode(' ', $request['search']) : '';


        $ordersp = Order::with(['customer', 'seller.shop'])
            ->where('seller_id', $seller)
            ->when($tab != 'all', function ($q) use ($tab) {
                $q->where(function ($query) use ($tab) {
                    $query->orWhere('order_status', $tab);
                });
            })
            ->when($filter, function ($q) use ($filter) {
                $q->when($filter == 'all', function ($q) {
                    return $q;
                })
                    ->when($filter == 'POS', function ($q) {
                        $q->whereHas('details', function ($q) {
                            $q->where('order_type', 'POS');
                        });
                    })
                    ->when($filter == 'admin' || $filter == 'seller', function ($q) use ($filter) {
                        $q->whereHas('details', function ($query) use ($filter) {
                            $query->whereHas('product', function ($query) use ($filter) {
                                $query->where('added_by', $filter);
                            });
                        });
                    });
            })
            ->when($request->has('search') && $search != null, function ($q) use ($key) {
                $q->where(function ($qq) use ($key) {
                    foreach ($key as $value) {
                        $qq->where('id', 'like', "%{$value}%")
                            ->orWhere('order_status', 'like', "%{$value}%")
                            ->orWhere('transaction_ref', 'like', "%{$value}%");
                    }
                });
            })
            ->when(!empty($from) && !empty($to), function ($dateQuery) use ($from, $to) {
                $dateQuery->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
            })
            ->orderBy('id', 'desc')
            ->paginate($paginate)->withQueryString()
            ->through(fn ($ordersp) => [
                'id' => $ordersp->id,
                'created_at' => $ordersp->created_at,
                'shipping_address_data' => $ordersp->shipping_address_data,
                'customer_name' => @$ordersp->customer->name,
                'customer_phone' => @$ordersp->customer->phone,
                'payment_status' => @$ordersp->payment_status,
                'shop' => @$ordersp->seller->shop->name,
                'total_amount' => $ordersp->order_amount,
                'order_status' => $ordersp->order_status,
                'order_status_date' => $ordersp->order_status_date,
            ]);
        $final_orders = $ordersp->map(function ($item) {
            $json_data = json_decode($item['shipping_address_data'], true);
            $results = LocatHub::where('area_id', 'LIKE', '%"' . $json_data['area_id'] . '"%')->get();
            foreach ($results as $result) {
                $item['hub_name'] = $result->name;
                $item['city'] = $json_data['city'];
                $item['thana'] = $json_data['thana'];
                $item['area'] = $json_data['zip'];
            }
            return $item;
        });
        $newPaginator = new LengthAwarePaginator(
            $final_orders,
            $ordersp->total(),
            $ordersp->perPage(),
            $ordersp->currentPage(),
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        $pending_query =Order::where(['order_status' => 'pending']);
        $pending_count = $this->common_query_status_count($pending_query, $tab, $request);

        $confirmed_query = Order::where(['order_status' => 'confirmed']);
        $confirmed_count = $this->common_query_status_count($confirmed_query, $tab, $request);

        $processing_query = Order::where(['order_status' => 'processing']);
        $processing_count = $this->common_query_status_count($processing_query, $tab, $request);

        $out_for_delivery_query = Order::where(['order_status' => 'out_for_delivery']);
        $out_for_delivery_count = $this->common_query_status_count($out_for_delivery_query, $tab, $request);

        $delivered_query = Order::where(['order_status' => 'delivered']);
        $delivered_count = $this->common_query_status_count($delivered_query, $tab, $request);

        $canceled_query = Order::where(['order_status' => 'canceled']);
        $canceled_count = $this->common_query_status_count($canceled_query, $tab, $request);

        $returned_query = Order::where(['order_status' => 'returned']);
        $returned_count = $this->common_query_status_count($returned_query, $tab, $request);

        $failed_query = Order::where(['order_status' => 'failed']);
        $failed_count = $this->common_query_status_count($failed_query, $tab, $request);
        return [
            'orders' => $newPaginator,
            'pending_count' => $pending_count,
            'confirmed_count' => $confirmed_count,
            'processing_count' => $processing_count,
            'out_for_delivery_count' => $out_for_delivery_count,
            'delivered_count' => $delivered_count,
            'canceled_count' => $canceled_count,
            'returned_count' => $returned_count,
            'failed_count' => $failed_count,
        ];
    }

    public function allProductsWithOrders($request)
    {
        $from = null;
        $to = null;

        if ($request && $request->from) {
            $from = $request->from;
        }

        if ($request && $request->to) {
            $to = $request->to;
        }

        $status_filter = null;
        if ($request && $request->order_status) {
            $status_filter = $request->order_status;
        }
        $id = null;
        if ($request->sub_sub_category_id) {
            $id = '"' . $request->sub_sub_category_id . '"';
        } elseif ($request->sub_category_id) {
            $id = '"' . $request->sub_category_id . '"';
        } elseif ($request->category_id) {
            $id = '"' . $request->category_id . '"';
        }
        $seller = auth()->user()->id;

        if ($request['paginate'] == null) {
            $request['paginate'] = 10;
        }

        $perPage = $request['paginate'];

        $query = "
            SELECT
            `products`.`id` AS product_id,
            `orders`.`id` AS order_id,
            `orders`.`created_at` AS order_created_at,
            `orders`.`updated_at` AS order_updated_at,
            `order_details`.`id` AS order_details_id,
            `order_details`.`variation` AS order_variation,
            `order_details`.`qty` AS order_qty,
            `order_details`.`price` AS order_price,
            `products`.`name`,
            `products`.`code`,
            `products`.`unit`,
            `products`.`category_ids`,
            `products`.`product_type`,
            `products`.`thumbnail`,
            `order_details`.`qty`,
            `order_details`.`price`,
            `order_details`.`variant`,
            `order_details`.`delivery_status`,
            `orders`.`order_status`,
            `order_details`.`discount`,
                (
                    SELECT COUNT(*)
                    FROM `reviews`
                    WHERE `products`.`id` = `reviews`.`product_id`
                ) AS `reviews_count`
            FROM
                `products`
            INNER JOIN
                `order_details`
            ON
                `products`.`id` = `order_details`.`product_id`
            INNER JOIN
                `orders`
            ON
                `order_details`.`order_id` = `orders`.`id`
            INNER JOIN
                `sellers`
            ON
                `orders`.`seller_id` = `sellers`.`id`
            WHERE
                `orders`.`seller_id` = ?
                AND (DATE(`orders`.`created_at`) BETWEEN ? AND ? OR ? IS NULL)
                AND (`orders`.`order_status` = ? OR ? IS NULL)
                AND `orders`.`order_status` != 'returned'
                AND `orders`.`order_status` != 'canceled'
        ";

        if ($id != null) {
            $query .= "AND `products`.`category_ids` LIKE CONCAT('%', ?, '%')";
            $bindings = [$seller, $from, $to, $from, $status_filter, $status_filter, $id];
        } else {
            $bindings = [$seller, $from, $to, $from, $status_filter, $status_filter];
        }

        $products = DB::select($query, $bindings);

        $groupedItems = [];

        foreach ($products as $item) {
            $productId = $item->product_id;

            if (!isset($groupedItems[$productId])) {
                $groupedItems[$productId] = [
                    'product_id' => $item->product_id,
                    'name' => $item->name,
                    'code' => $item->code,
                    'unit' => $item->unit,
                    'product_type' => $item->product_type,
                    'thumbnail' => $item->thumbnail,
                    'orders' => [],
                ];
            }

            $orderInfo = [
                'order_qty' => $item->order_qty,
                'order_price' => $item->order_price,
                'variant' => $item->variant,
                'delivery_status' => $item->delivery_status,
                'order_status' => $item->order_status,
                'discount' => $item->discount,
                'order_id' => $item->order_id,
                'order_created_at' => $item->order_created_at,
                'order_updated_at' => $item->order_updated_at,
                'order_variation' => json_decode($item->order_variation, true),
            ];

            $groupedItems[$productId]['orders'][] = $orderInfo;
        }
        $groupedItemsArray = array_values($groupedItems);
        $currentPage = Paginator::resolveCurrentPage();

        $start = ($currentPage - 1) * $perPage;
        $slicedGroupedItems = array_slice($groupedItemsArray, $start, $perPage, true);

        $products = new LengthAwarePaginator(
            $slicedGroupedItems,
            count($groupedItemsArray),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        $products->appends(request()->query());
        return $products;
    }

    function productList($request)
    {
        $paginate = $request['paginate'];
        $seller = auth()->user()->id;
        $query_param = [];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $products = Product::where(['added_by' => 'seller', 'user_id' => $seller])
                ->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->Where('name', 'like', "%{$value}%");
                    }
                });
            $query_param = ['search' => $request['search']];
        } else {
            $products = Product::where(['added_by' => 'seller', 'user_id' => $seller]);
        }
        $products = $products->orderBy('id', 'DESC')->paginate($paginate)->appends($query_param);

        return $products;
    }
    public function myShop()
    {
        $shop = Shop::where(['seller_id' => auth()->user()->id])->first();
        if (isset($shop) == false) {
            Shop::insert([
                'seller_id' => auth()->user()->id,
                'name' => auth()->user()->f_name . ' ' . auth()->user()->l_name,
                'address' => '',
                'contact' => auth()->user()->phone,
                'image' => 'def.png',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $shop = Shop::where(['seller_id' => auth()->user()->id])->first();
        }
        if ($shop) {
            $myShop = [
                'id' => $shop->id,
                'name' => $shop->name,
                'address' => $shop->address,
                'contact' => $shop->contact,
                'image' => $shop->image,
                'banner' => $shop->banner,
            ];
        }

        return $myShop;
    }
    public function updateShop($request)
    {
        $request->validate([
            'banner'      => 'mimes:png,jpg,jpeg|max:2048',
            'image'       => 'mimes:png,jpg,jpeg|max:2048',
        ], [
            'banner.mimes'   => 'Banner image type jpg, jpeg or png',
            'banner.max'     => 'Banner Maximum size 2MB',
            'image.mimes'    => 'Image type jpg, jpeg or png',
            'image.max'      => 'Image Maximum size 2MB',
        ]);

        $shop = Shop::where(['seller_id' => auth()->user()->id])->first();;
        $shop->name = $request->name;
        $shop->address = $request->address;
        $shop->contact = $request->contact;
        if ($request->image) {
            $shop->image = ImageSizeManager::update('shop/', $shop->image, 'png', $request->file('image'));
        }
        if ($request->banner) {
            $shop->banner = ImageSizeManager::update('shop/banner/', $shop->banner, 'png', $request->file('banner'));
        }
        $shop->save();
    }
    public function common_query_status_count($query, $status, $request)
    {
        $search = $request['search'];
        $filter = $request['filter'];
        $from = $request['from'];
        $to = $request['to'];
        $key = $request['search'] ? explode(' ', $request['search']) : '';

        return $query->when($status != 'all', function ($q) use ($status) {
            $q->where(function ($query) use ($status) {
                $query->orWhere('order_status', $status);
            });
        })
            ->when($filter, function ($q) use ($filter) {
                $q->when($filter == 'all', function ($q) {
                    return $q;
                })
                    ->when($filter == 'POS', function ($q) {
                        $q->whereHas('details', function ($q) {
                            $q->where('order_type', 'POS');
                        });
                    })
                    ->when($filter == 'admin' || $filter == 'seller', function ($q) use ($filter) {
                        $q->whereHas('details', function ($query) use ($filter) {
                            $query->whereHas('product', function ($query) use ($filter) {
                                $query->where('added_by', $filter);
                            });
                        });
                    });
            })
            ->when($request->has('search') && $search != null, function ($q) use ($key) {
                $q->where(function ($qq) use ($key) {
                    foreach ($key as $value) {
                        $qq->where('id', 'like', "%{$value}%")
                            ->orWhere('order_status', 'like', "%{$value}%")
                            ->orWhere('transaction_ref', 'like', "%{$value}%");
                    }
                });
            })->when(!empty($from) && !empty($to), function ($dateQuery) use ($from, $to) {
                $dateQuery->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
            })->count();
    }
}
