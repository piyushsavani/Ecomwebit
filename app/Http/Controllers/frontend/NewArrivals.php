<?php

namespace App\Http\Controllers\frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewArrivals extends Controller
{
    public function newArrivals()
    {
        $newArrivals = Product::latest()->get();
        return view('frontend.newarrivals.index', compact('newArrivals'));
    }
}
