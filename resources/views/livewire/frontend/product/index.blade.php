<div>
@if(session('message'))
<div class="alert alert-success"> {{ session('message') }} </div>
@endif
    <div class="row">
        <div class="col-md-3">
            <h5>Brands</h5>
            @foreach($category->brands as $brandItem)
            <label class="d-block">
                <input type="checkbox" wire:model="brandInputs" value="{{$brandItem->name}}"
                    class="my-2 mx-2" />{{$brandItem->name}}
            </label>
            @endforeach
            <br>
            <h5>Price</h5>
            <label class="d-block">
                <input type="radio" wire:model="priceInputs" value="high-to-low" class="my-2 mx-2" />Hogh to Low <br>
                <input type="radio" wire:model="priceInputs" value="low-to-high" class="my-2 mx-2" />Low to Hogh 
            </label>

        </div>
        <div class="row col-md-9">
            @forelse($products as $product)
            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-card-img">
                        @if($product->qauntity > 0)
                        <label class="stock bg-success">In Stock</label>
                        @else
                        <label class="stock bg-danger">Out of Stock</label>
                        @endif

                        @if($product->productImages)
                        <a href="{{ url('collections/'.$product->category->slug.'/'.$product->product_slug) }}"> <img
                                src="{{ asset($product->productImages[0]->image) }}" class="img-fluid" alt="NO Img"></a>
                        @endif
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{$product->brand}}</p>
                        <h5 class="product-name">
                            <a href="{{ url('collections/'.$product->category->slug.'/'.$product->product_slug) }}">
                                {{$product->product_name}}
                            </a>
                        </h5>
                        <div>
                            <span class="selling-price">Rs. {{$product->selling_price}}</span>
                            <!-- <span class="original-price">${{$product->original_price}}</span> -->
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{ $product->id }}, {{$product->selling_price}} )" class="btn btn1">Add To Cart</button>
                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                            <a href="{{ url('collections/'.$product->category->slug.'/'.$product->product_slug) }}" class="btn btn1"> View </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12"> No Products available for <b> {{ $category->name }} </b> Category</div>
            @endforelse
        </div>
    </div>