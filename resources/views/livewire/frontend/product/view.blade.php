<div>
@if(session('message'))
<div class="alert alert-success"> {{ session('message') }} </div>
@endif
<div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border">
                        <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img">
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">                            
                            {{$product->product_name}} <br>
                           
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{$category->name}} / {{$product->product_name}} / {{$product->brand}}
                        </p>
                        <div>
                            <input type="hidden" wire:model="price" value="{{ $product->selling_price }}" class="selling-price">
                            <span wire:model="price" class="selling-price">Rs. {{$product->selling_price}}</span>
                        </div><br>

                        @if($product->productColors)
                        @foreach($product->productColors as $productColor)
                        <button type="radio" wire:click="colorSelection({{ $productColor->id }})" name="colorSelection" value=" {{$productColor->id}}" style="background-color: {{ $productColor->colors->color_code }} " class="btn-sm"> {{$productColor->colors->color_name}} </button>
                        @endforeach                        
                       
                            @if($selectedProductColorTotalQty == 'OutOfStock')                            
                            <label class="label-stock bg-danger btn-sm text-white">Out of Stock</label>  
                            @else         
                            <label class="label-stock bg-success btn-sm text-white">In Stock </label>            
                            @endif
                        @else
                            @if($product->qauntity > 0)                            
                            <label class="stock bg-danger text-white">Out of Stock</label>
                            @else
                            <label class="stock bg-success text-white">In Stock</label>
                            @endif
                        @endif                        

                        <div class="mt-2">
                            <div class="input-group">
                                <span wire:click="decreaseQnt" class="btn btn1"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="qty" value="{{ $this->qty }}" class="input-quantity" />
                                <span wire:click="increaseQnt" class="btn btn1"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{ $product->id }}, {{ $product->selling_price }})" class="btn btn1"> 
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>

                            <button type="button" wire:click="addToWishlist({{ $product->id }})" class="btn btn1"> 
                                <span type="button" wire:loading.remove wire:terget="addToWishlist({{ $product->id }})" > <i class="fa fa-heart"></i> Add To Wishlist </span>
                                <span type="button" wire:loading wire:terget="addToWishlist({{ $product->id }})" > Adding ... </span>                                
                            </button>
                        </div>
                        
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                               {{$product->description}}
                            </p>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                            {{$product->description}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
</div>
