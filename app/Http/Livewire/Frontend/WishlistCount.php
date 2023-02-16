<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Frontend\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistCount extends Component
{
    public $wishlistCount;

    protected $listeners = ['wishlistUpdateAdd' => 'wishlistCount'];

    public function wishlistCount()
    {
        if(Auth::check()){
        $wishlistCount = Wishlist::where('user_id', auth()->user()->id)->count();
        $this->wishlistCount = $wishlistCount;
    } else {
        $this->wishlistCount = 0;
    }
}
    public function render()
    {    
        $this->wishlistCount();    
        return view('livewire.frontend.wishlist-count', [
            'wishlistCount' => $this->wishlistCount
        ]);
    }
}
