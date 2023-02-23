<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Models\frontend\Cart;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        return view('frontend.collections.product.cart');
    }
}
