<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Frontend\Wishlist;

class WishlistShow extends Component
{
   public function removeWishlist($wishlistId){
         Wishlist::where('id', $wishlistId)->delete();
         
         $this->emit('wishlistUpdateAdd');
    }

   public function render()
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show', ['wishlists' => $wishlists]);
    }
}
