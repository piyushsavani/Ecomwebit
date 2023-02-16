<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $products, $category, $brandInputs = [], $priceInputs, $qty = 1;

    protected $queryString = ['brandInputs'];
    protected $queryString1 = ['priceInputs'];

    public function mount($category)
    {
        
        $this->category = $category;
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
