<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\frontend\Cart;
use Illuminate\Support\Facades\Auth;

class CartShow extends Component
{
    public $totalPrice = 0, $cart, $cartQnt;

   
    public function cartQuantityIncrement($cartId)
    {
        $cartItem = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        if($cartItem) 
        {
            $cartItem->increment('quantity');
        }
    }

    public function cartQuantityDecrement($cartId)
    {
        $cartItem = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        if($cartItem->quantity > 1) 
        {
            $cartItem->decrement('quantity');
        }
    }

    public function removeCartItem($cartItemId) 
    {
        if(Auth::check())
        {
            Cart::where('user_id', auth()->user()->id)->where('id', $cartItemId)->delete();
            session()->flash('message','Item Removed From Cart');
            $this->emit('cartUpdate');            
            return redirect()->back();
        } else {
            session()->flash('message','Please Login First else you are not Authenticated');
        }
    }   
           

    public function render()
    {        
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();        
        return view('livewire.frontend.cart-show', [
            'cart' => $this->cart,                     
        ]);
    }
}
