@extends('layouts.admin.dashboard')

@section('content')

@if(session()->get('errors'))
toastr.error("{{ session()->get('errors')->first() }}");
@endif

<form action="{{ url('admin/product/'.$product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    
    @method('PUT')
    <div class="container">
        <table class="table-bordered mb-3">
            <h3 style="color: blue;"><b> Edit Product</b></h3>
        </table>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Select Category</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{$category->id==$product->category_id ? 'selected':''}}
                    </option> {{ $category->name }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="name">Product Name</label>
                <input type="text" value="{{ $product->product_name }}" name="product_name" class="form-control">
            </div>

            <div class="col-md-4 mb-2">
            <label>Select Brand</label>
            <select name="brand" class="form-control">
                
                    @foreach($brands as $brand)
                    <option value="{{ $brand->name }}"> {{ $brand->name }} </option>
                    @endforeach
                    
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="slug">Product slug</label>
                <input type="text" value="{{ $product->product_slug }}" name="product_slug" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" rows="4">{{ $product->description }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="meta_title">meta_title</label>
                <input type="text" value="{{$product->meta_title}}" name="meta_title" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="meta_keyword">meta_keyword</label>
                <input type="text" value="{{$product->meta_keyword}}" name="meta_keyword" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="name">Selling Price</label>
                <input type="number" value="{{$product->selling_price}}" name="selling_price" class="form-control">
            </div>
            <div class="col-md-3 mb-3">
                <label for="name">Qauntity</label>
                <input type="number" value="{{$product->qauntity}}" name="qauntity" class="form-control">
            </div>
            <div class="col-md-3 mb-3">
                <label for="status">Status</label><br>
                <input type="checkbox" value="{{$product->status == 1 ? 'checked':''}}" name="status" />
            </div>
            <div class="col-md-3 mb-3">
                <label for="status">Trending</label><br>
                <input type="checkbox" value="{{$product->trending == 1 ? 'checked':'Un-checked'}}" name="trending" />
            </div>

            <div class="col-md-12 mb-3">
                <label for="meta_description">Meta Description</label>
                <textarea class="form-control" name="meta_description"
                    rows="3">{{ $product->meta_description }}</textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label for="image">Upload Product Images</label><br>
                <input type="file" multiple name="image[]" />
                <div>
                    @if($product->productImages)
                    <div class="row">
                        @foreach ($product->productImages as $image)
                        <div class="col-md-2">
                            <img src="{{ asset('Admin/uploads/product/'.$image->image) }}" class="p-2"
                                style="height:80px; width:80px;" alt="ni">
                            <a href="{{ url('admin/img-remove/'.$image->id) }}" class='d-block'>Remove</a>
                        </div>
                        @endforeach
                        @else
                        <h3>No Image Added</h3>
                    </div>
                    @endif
                </div>
            </div>
            <div class="mb-3">
                <label for="image"><b>Color and Quantity</b> </label><br>
                <div class="row">
                    @foreach($colors as $color)
                    <div class="col-md-3 mb-3">
                        <div class="p-2 bordered">
                            <b>Color:</b> <input type="checkbox" value="{{ $color->id }}"
                                name="colors[{{ $color->id }}]" value="{{ $color->id }}" /> {{ $color->color_name }}
                            <br />
                            <b>Quantity:</b> <input type="text" style="width:70px;"
                                name="colorquantity[{{ $color->id }}]" />
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <h3><b> Add Colors </b></h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Color Name</th>
                            <th>Quantity</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product->productColors as $prodColor)
                        <div class="col-md-3">
                            <tr class="prod-color-tr">
                                @if($prodColor->colors)
                                <td> {{ $prodColor->colors->color_name }} </td>
                                @else
                                <h3>No Color FOund</h3>
                                @endif
                                <td>
                                    <div class="input-group">
                                        <input type="text" value="{{$prodColor->quantity}}" name="prodColorQuantity"
                                            id="">
                                        <button type="button" value="{{$prodColor->id}}"
                                            class="updateProductColorBtn btn btn-primary btn-sm text-white">update</button>
                                    </div>
                                </td>
                                <td>
                                    <button
                                        class="deleteProductColorBtn btn btn-primary btn-sm text-white mt-3">Delete</button>
                                </td>
                            </tr>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button class="btn btn-primary float-end">Update Product</button>
        </div>
    </div>

    </div>
    </div>
</form>

@endsection

@section('scripts')
<script>

    $(document).ready(function () {

        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

        $(document).on('click', '.updateProductColorBtn', function () {

            var product_id = "{{$product->id}}";
            var prod_color_id = $(this).val();
            var qty = $(this).closest('.prod-color-tr').find('.prodColorQuantity').val();

            if (qty <= 0) {
                alert('Please fill Quantity');
            }
            var data = {
                'product_id': product_id,
                'qty': qty
            }
            
            $.ajax({
                type: "POST",
                url: "admin/product-color/"+prod_color_id,
                data: "data",
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    alert('response.message');
                }



               });

        });

        });

       
        
    

</script>

@endsection