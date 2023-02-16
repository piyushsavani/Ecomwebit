<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Models\Frontend\Wishlist;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
  public  function index()
    {
        return view('frontend.collections.product.wishlist');
    }
}
