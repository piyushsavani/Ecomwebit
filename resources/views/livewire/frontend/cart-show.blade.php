<div>
<div class="py-3 py-md-5 bg-light">
        <div class="container">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">
                    @if($cart->count() > 0)
                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Total Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @endif
                        @forelse($cart as $cartItem)
                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-4 my-auto">
                                    <a href="">
                                        <label class="product-name">
                                            <img src="{{asset($cartItem->products->productImages[0]->image)}}" style="width: 50px; height: 50px" alt="">
                                            {{$cartItem->products->product_name}}  
                                            @if($cartItem->products->productColors()->exists())
                                            : color - {{$cartItem->colors->color_name}}
                                            @endif
                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">Rs. {{$cartItem->price}} </label>                                    
                                </div>
                                <div class="col-md-2 col-7 my-auto">
                                    <div class="quantity">
                                        <div class="input-group">
                                            <button wire:click="cartQuantityDecrement({{ $cartItem->id }})" class="btn btn1"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="{{ $cartItem->quantity }}" class="input-quantity" />
                                            <button wire:click="cartQuantityIncrement({{ $cartItem->id }})" class="btn btn1"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">Rs. {{$cartItem->price*$cartItem->quantity}} </label>
                                    @php $totalPrice += $cartItem->price*$cartItem->quantity @endphp
                                </div>
                                <div class="col-md-2 col-5 my-auto">
                                    <div class="remove">
                                        <button href="button" wire:click="removeCartItem({{ $cartItem->id }})" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        @empty
                        <div class="my-3 text-center"><h5> No Items Added in Cart </h5></div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="my-5">
            <div class="row">
                <div class="col-md-8">
                    <h4>To Get the Best deals & offers <a href="{{ url('/collections') }}"> Click here </a> </h4>
                </div>
              <div class="col-md-4">
                <h4><span class="float-end"> Total Price {{ $totalPrice }} </span> </h4>
                <a href="{{ url('/checkout') }}" class="btn btn-warning my-4 w-100"> Checkout </a>
              </div>      
            </div>
            </div>
        </div>
    </div>
</div>
