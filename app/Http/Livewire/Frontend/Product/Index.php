<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\frontend\Cart;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $products, $category, $brandInputs = [], $price, $priceInputs, $qty = 1;

    protected $queryString = ['brandInputs'];
    protected $queryString1 = ['priceInputs'];

    public function mount($category)
    {
        
        $this->category = $category;
    }

    public function addToCart($productId, $price)
    {
        if(Auth::check()){
            $this->price = $price;
                        
            if(Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()){

                session()->flash('message','Already added this product in cart');
                return redirect()->back();
                
            } else {

                Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $productId,
                'quantity' => $this->qty,
                'price' => $this->price
            ]);

                session()->flash('message','Product Added Successfully in Cart');
                return redirect()->back();
        
            }

           } else {

            session()->flash('message','Please login first to Add into cart');
            return redirect()->back();
        }       
        
    }
    
    public function render()
    {
        $this->products = Product::where('category_id',$this->category->id)
        ->when($this->brandInputs, function($q){
            $q->whereIn('brand',$this->brandInputs);
        })

        ->when($this->priceInputs, function($q){

            $q->when($this->priceInputs == "high-to-low", function($q2){
                   $q2->orderBy('selling_price','DESC');
            })
            
            ->when($this->priceInputs == "low-to-high", function($q2){
            $q2->orderBy('selling_price','ASC');
            
            });
        })
        ->get();

        return view('livewire.frontend.product.index', [
            'products' => $this->products,
            'category' => $this->category
        ]);
    }

    public function decreaseQnt()
    {
        $this->qty--;
    }

    public function increaseQnt()
    {
        $this->qty++;
    }
}
