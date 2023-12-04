<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Models\Order;
use App\Repository\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{

    public $orders;
    public function __construct(OrderRepositoryInterface $order)
    {
        $this->orders = $order;
    }
    public function index(Request $request, $tab)
    {
        $request['tab'] = $tab;
        $all_data = $this->orders->index($request,$tab);
        return Inertia::render('Orders/Index', [
            'filters' => $request->all(),
            'orders' => $all_data,
        ]);
    }
}
