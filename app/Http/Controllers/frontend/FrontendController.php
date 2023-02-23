<?php

namespace App\Http\Controllers\frontend;

use App\Models\Slider;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('frontend.index', compact('sliders'));
    }

    public function collections()
    {
        $categories = Category::all();  
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->first();
        if($category){
            return view('frontend.collections.category.view', compact('category'));
        }
        else{
            return redirect()->back();
        }
        
    }

    public function viewProducts($categorySlug, $productSlug)
    {
        $category = Category::where('slug', $categorySlug)->first();
        if($category){

            $product = Product::where('product_slug',$productSlug)->first();
            return view('frontend.collections.product.index', compact('product','category'));
        }
        else{
            return redirect()->back();
        }        
    }

    public function thankYou()
    {
        return view('frontend.checkout.thank-you');
    }
}
