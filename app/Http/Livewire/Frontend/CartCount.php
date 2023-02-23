<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\frontend\Cart;
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{
    public $cartCount;
    protected $listeners = ['cartUpdate' => 'cartCount'];

    public function cartCount()
    {
        if (Auth::check()) {
            $cartCount = Cart::where('user_id', auth()->user()->id)->count();
            $this->cartCount = $cartCount;
        } else {
            $this->cartCount = 0;
        }          
    }

    public function render()
    {
        $this->cartCount();
        return view('livewire.frontend.cart-count', [
            'cartCount' => $this->cartCount
        ]);
    }
}
