@extends('layouts.admin.dashboard')

@section('content')

@if (session('message'))
<div class="alert alert-success"> {{ (session('message')) }}</div>
@endif

<div class = "alert alert-error">                      
  @foreach ($errors->all('<p>:message</p>') as $input_error)
    {{ $input_error }}
  @endforeach 
</div> 

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">        
        <h2><b> Product List</b></h2> <a href="{{ url('admin/add-product') }}" class="btn btn-success float-end">Add Product</a>        
      </div>

        <div class="card-body">
          <table class="table-bordered table-striped">
            <thead> 
              <tr>
                <th class="col-md-1" style="text-align: center;"> Product ID </th>
                <th class="col-md-2 my-2" style="text-align: center;"> Product Name </th>                
                <th class="col-md-2 my-2" style="text-align: center;"> Brand Name </th>                
                <th class="col-md-2" style="text-align: center;"> Category </th>
                <th class="col-md-1" style="text-align: center;"> Price </th>
                <th class="col-md-1" style="text-align: center;"> Trending </th>
                <th class="col-md-1" style="text-align: center;"> Quantity </th>
                <th class="col-md-2" style="text-align: center;"> Action </th>
              </tr>
            </thead>
            @forelse($products as $product)
            <tr>
              <td style="text-align: center;"> {{$product->id}} </td>
              <td style="text-align: center;"> {{$product->product_name}} </td>  
              <td style="text-align: center;"> {{$product->brand}} </td>  
                          
              <td style="text-align: center;"> @if($product->category) {{$product->category->name}} @endif </td>
              <td style="text-align: center;"> {{$product->selling_price}} </td>
              <td style="text-align: center;"> {{$product->trending == 1 ? 'trending':'not-trending'}} </td>
              <td style="text-align: center;"> {{$product->qauntity}} </td>
              <td style="text-align: center;">
              <a href="{{ url('admin/product/'.$product->id) }}" class="btn btn-success btn-sm"> Edit </a> 
              <a href="{{ url('admin/delete/'.$product->id) }}" class="btn btn-danger my-2 btn-sm">Delete</a>
              </td>
            </tr> 
            @empty 
            <tr><td colspan='7'> <h4 class="mb-3 p-2" style="color:red;text-align: center; padding-top:5px;">No Product Found</h4> </td></tr>
            @endforelse
          </table>
        </div>
     
        
      </div>
    </div>
  </div>


@endsection