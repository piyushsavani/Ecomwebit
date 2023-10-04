@extends('layouts.admin.dashboard')

@section('content')
@if(session()->get('errors'))
toastr.error("{{ session()->get('errors')->first() }}");
@endif

<form action="{{ url('admin/product')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="container">
        <table class="table-bordered mb-3">
            <h3 style="color: blue;"><b> Add Product</b></h3>
        </table>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Select Category</label>
                <select name="category_id" class="form-control">
                    @foreach($cagtegories as $category)
                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-2">
                <label for="name"> Name </label>
                <input type="text" name="product_name" class="form-control">
            </div>
            <div class="col-md-4 mb-2">
            <label>Select Brand</label>
            <select name="brand" class="form-control">                
                    @foreach($brands as $brand)
                    <option value="{{ $brand->name }}"> {{ $brand->name }} </option>
                    @endforeach                    
            </select>
            </div>
            <div class="col-md-4 mb-2">
                <label for="slug">Product slug</label>
                <input type="text" name="product_slug" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" rows="4"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="meta_title">meta_title</label>
                <input type="text" name="meta_title" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="meta_keyword">meta_keyword</label>
                <input type="text" name="meta_keyword" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="name">Selling Price</label>
                <input type="number" name="selling_price" class="form-control">
            </div>
            <div class="col-md-3 mb-3">
                <label for="name">Qauntity</label>
                <input type="number" name="qauntity" class="form-control">
            </div>
            <div class="col-md-3 mb-3">
                <label for="status">Status</label><br>
                <input type="checkbox" name="status" />
            </div>
            <div class="col-md-3 mb-3">
                <label for="status">Trending</label><br>
                <input type="checkbox" name="trending" />
            </div>

            <div class="col-md-12 mb-3">
                <label for="meta_description">Meta Description</label>
                <textarea class="form-control" name="meta_description" rows="3"></textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label for="image">Upload Product Images</label><br>
                <input type="file" multiple name="image[]" />
            </div>
            
            <div class="mb-3">
                <label for="image"><b>Color and Quantity</b> </label><br>
                <div class="row">
                    @foreach($colors as $color)
                    <div class="col-md-3 mb-3">
                        <div class="p-2 bordered">
                            <b>Color:</b> <input type="checkbox" value="{{ $color->id }}" name="colors[{{ $color->id }}]" /> {{ $color->color_name }} <br />
                            <b>Quantity:</b> <input type="text" style="width:70px;" name="colorquantity[{{ $color->id }}]" />
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>

    </div>
    </div>
</form>

@endsection