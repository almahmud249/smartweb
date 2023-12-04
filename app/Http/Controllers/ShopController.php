<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Index');
    }
}
