<?php

namespace App\Repository\Contracts;

use http\Env\Request;

interface OrderRepositoryInterface
{
    public function index($request, $tab);
    public function allProductsWithOrders($request);

    public function productList($request);
    public function myShop();
    public function updateShop($request);
}