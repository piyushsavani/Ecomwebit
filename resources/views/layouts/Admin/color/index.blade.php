@extends('layouts.admin.dashboard')

@section('content')

@if (session('message'))
<div class="alert alert-success"> {{ (session('message')) }}</div>
@endif

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">        
        <h2><b> Color List</b></h2> <a href="{{ url('admin/add-color') }}" class="btn btn-success float-end">Add Color</a>        
      </div>

        <div class="card-body">
          <table class="table-bordered table-striped">
            <thead> 
              <tr>
                <th class="col-md-2" style="text-align: center;"> Color ID </th>
                <th class="col-md-2" style="text-align: center;"> Color Name </th>                
                <th class="col-md-2" style="text-align: center;"> Color code </th>             
                <th class="col-md-2" style="text-align: center;"> Color Status </th>             
                <th class="col-md-2" style="text-align: center;"> Action </th>
              </tr>
            </thead>
            @forelse($colors as $color)
            <tr>
              <td style="text-align: center;"> {{$color->id}} </td>
              <td style="text-align: center;"> {{$color->color_name}} </td>  
              <td style="text-align: center;"> {{$color->color_code}} </td>
              <td style="text-align: center;"> {{$color->status == 1 ? 'Hidden':'visible'}} </td>
              
              <td style="text-align: center;">
              <a href="{{ url('admin/color/'.$color->id) }}" class="btn btn-success btn-sm"> Edit </a> 
              <a href="{{ url('admin/delete/color/'.$color->id) }}" onclick="return confirm('Are you sure want to delete this color ?')" class="btn btn-danger my-2 btn-sm">Delete</a>
              </td>
            </tr> 
            @empty 
            <tr><td colspan='7'> <h4 class="mb-3 p-2" style="color:red;text-align: center; padding-top:5px;">No Colors Found</h4> </td></tr>
            @endforelse
          </table>
        </div>
     
        
      </div>
    </div>
  </div>


@endsection