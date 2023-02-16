<div>
<div class="py-3 py-md-5 bg-light">
        <div class="container">
    
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                
                                <div class="col-md-4">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @foreach($wishlists as $wishlistItem)
                        <div class="cart-item">
                            <div class="row">
                            
                                <div class="col-md-6 my-auto">
                                    <a href="{{ url('collections/'.$wishlistItem->products->category->slug.'/'.$wishlistItem->products->product_slug) }}">
                                        <label class="product-name">
                                            <img src="{{ $wishlistItem->products->productImages[0]->image }}" style="width: 50px; height: 50px" alt="">
                                                {{ $wishlistItem->products->product_name }}
                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">Rs. {{ $wishlistItem->products->selling_price }} </label>
                                </div>
                                
                                <div class="col-md-2 col-5 my-auto">
                                    <div class="remove">
                                        <button type="button" wire:click="removeWishlist({{ $wishlistItem->id }})" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach                       
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
