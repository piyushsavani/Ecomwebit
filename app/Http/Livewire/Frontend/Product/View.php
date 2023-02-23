<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use App\Models\frontend\Cart;
use App\Models\Frontend\Wishlist;
use App\Models\admin\ProductColor;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $product, $category, $qty = 1, $selectedProductColorTotalQty = 1, $totalQtyAvailable, $productColorId = NULL, $price;

    public function mount($product, $category)
    {
        $this->render();
        $this->product = $product;
        $this->category = $category;
    }

    public function addToCart($productId, $price)
    {
        $this->price = $price;
       if (Auth::check())
        {
        if ($this->product->where('id',$productId)->exists())
        { 
            if ($this->product->qauntity > 0) 
            { 
                if ($this->product->productColors()->count() > 0) 
                {
                    
                    if (Cart::where('user_id', auth()->user()->id)
                                      ->where('color_id', $this->productColorId)
                                      ->where('product_id', $productId)->exists())                   
                    
                    {
                        session()->flash('message','Product Already Added in cart');
                        return redirect()->back();
                    } else {
                    
                        if ($this->totalQtyAvailable != NULL) {
                        Cart::create([
                            'user_id' => auth()->user()->id,
                            'product_id' => $productId,
                            'quantity' => $this->qty,
                            'price' => $this->price,
                            'color_id' => $this->productColorId
                        ]);
                        session()->flash('message','Product Added Successfully in cart');
                        $this->emit('cartUpdate');
                        return redirect()->back(); 
                        
                        } else {                        
                        // dd('Please select color');
                        session()->flash('message','Please Select Color');
                        return redirect()->back(); 
                        }  
                    }
                    
                } else {
                    if ($this->product->qauntity > $this->qty) {
                        if (Cart::where('user_id', auth()->user()->id)
                                          ->where('product_id', $productId)->exists()) 
                        {
                            session()->flash('message','Product Already Exists in cart');
                            return redirect()->back();
                        } else 
                        { 
                             // dd('ready to inert data');
                        Cart::create([
                            'user_id' => auth()->user()->id,
                            'product_id' => $productId,
                            'quantity' => $this->qty,
                            'price' => $this->price
                        ]);
                        session()->flash('message','Product Added Successfully in cart');
                        $this->emit('cartUpdate');
                        return redirect()->back(); 
                        
                        }

                    } else { 
                        session()->flash('message','Insufficient Quantity available');
                        return redirect()->back();
                    }
                    
                }
                
            } else {
                session()->flash('message','Out of Stock');
                return redirect()->back();
            }
            
        } else {
            session()->flash('message','Product Does Not Exists');
            return redirect()->back();
        }
        
       } else {
        session()->flash('message','Please login First');
        return redirect()->back();
       }
       
    }        
    
    public function colorSelection($productColorId)
    {
        // dd($productColorId);
        $this->productColorId = $productColorId;
        $selectedProductColor = $this->product->productColors->where('id',$productColorId)->first();        
        $totalQtyAvailable = $selectedProductColor->quantity;
        $this->totalQtyAvailable = $totalQtyAvailable;
        // dd($this->qty);

        if($this->qty > $totalQtyAvailable){

            session()->flash('message','Less qty available');
            $this->selectedProductColorTotalQty = 'OutOfStock';
            // return true;
            
           
        } else {

            $this->selectedProductColorTotalQty = $this->qty;
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
            'selectedProductColorTotalQty' => $this->selectedProductColorTotalQty
        ]);
    }
}