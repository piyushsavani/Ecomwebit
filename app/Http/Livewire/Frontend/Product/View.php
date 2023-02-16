<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use App\Models\Frontend\Wishlist;
use App\Models\admin\ProductColor;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $product, $category, $qty = 1, $prodQuantityAll;

    public function mount($product, $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function addToCart($productId)
    {
        if(Auth::check()){
            dd($productId);
        }
        else
    {
        session()->flash('messgae', 'Please loggin first to Add to cart');
        return redirect()->back();
    }
    }
    
    public function colorQuantity($colorItemId)
    {
        $prodQuantity = ProductColor::where('id',$colorItemId)->first();
        if($prodQuantity){
            $prodQuantityAll = $prodQuantity->quantity;
            $this->prodQuantityAll = $prodQuantityAll;
        } else {
            $this->prodQuantityAll = "OutOfStock";
        }

    }
        

    public function addToWishlist($productId)
    {

        if(Auth::check()){
            if(Wishlist::where('user_id',auth()->user()->id)->where('product_id', $productId)->exists()){

                session()->flash('message','Already added this wishlist');
                return redirect()->back();
            }

            Wishlist::create([
                'user_id' => auth()->user()->id,
                'product_id' => $productId
            ]);
            
            session()->flash('message','Wishlist Added Successfully');
            $this->emit('wishlistUpdateAdd');
            return redirect()->back();

        } else {

            session()->flash('message','Please login first');
            return redirect()->back();
        }       
        
    }

    public function increaseQnt()
    {
        $this->qty++;
    }

    public function decreaseQnt()
    {
        if($this->qty > 1){
        $this->qty--;
    }
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'product' => $this->product, 
            'category' => $this->category,
            'prodQuantityAll' => $this->prodQuantityAll
        ]);
    }
}
