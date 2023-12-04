<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repository\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $orders;

    public function __construct(OrderRepositoryInterface $orders)
    {
        $this->orders = $orders;
    }

    public function index(Request $request, $tab)
    {
        try {
            $orders = $this->orders->index($request, $tab);
            return response()->json([
                'success' => 'Data fetched successfully',
                'orders' => $orders
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something Went Wrong',
            ]);
        }
    }
    public function allProductsWithOrders(Request $request)
    {
        try {
            $products = $this->orders->allProductsWithOrders($request);
            return response()->json([
                'success' => 'Data fetched successfully',
                'products' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something Went Wrong',
            ]);
        }
    }

    public function productList(Request $request)
    {
        try {
            $products = $this->orders->productList($request);
            return response()->json([
                'success' => 'Data fetched successfully',
                'products' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something Went Wrong',
            ]);
        }
    }
    public function myShop()
    {
        try {
            $shop = $this->orders->myShop();
            return response()->json([
                'success' => 'Data fetched successfully',
                'shop' => $shop
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something Went Wrong',
            ]);
        }
    }
    public function updateShop(Request $request)
    {
        try {
            $this->orders->updateShop($request);
            return response()->json([
                'success' => 'Shop Updated successfully',
            ]);
        } catch (\Exception $e) {
            dd($e);

            return response()->json([
                'error' => 'Something Went Wrong',
            ]);
        }
    }
}