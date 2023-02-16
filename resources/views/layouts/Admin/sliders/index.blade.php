@extends('layouts.admin.dashboard')

@section('content')

@if (session('message'))
<div class="alert alert-success"> {{ (session('message')) }}</div>
@endif

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">        
        <h2><b> Slider List</b></h2> <a href="{{ url('admin/sliders/create') }}" class="btn btn-success float-end">Add slider</a>        
      </div>

        <div class="card-body">
          <table class="table-bordered table-striped">
            <thead> 
              <tr>
                <th class="col-md-2" style="text-align: center;"> Slider ID </th>
                <th class="col-md-2" style="text-align: center;"> Title </th>                
                <th class="col-md-2" style="text-align: center;"> Description</th>             
                <th class="col-md-2" style="text-align: center;"> Image </th>             
                <th class="col-md-2" style="text-align: center;"> Action </th>
              </tr>
            </thead>
            @forelse($sliders as $slider)
            <tr>
              <td style="text-align: center;"> {{$slider->id}} </td>
              <td style="text-align: center;"> {{$slider->title}} </td>  
              <td style="text-align: center;"> {{$slider->description}} </td>
              <td>
                    <img src="{{ asset("$slider->image") }}" style="width:70px; height:70px;" alt="slider">
              </td>              
              <td style="text-align: center;">
              <a href="{{ url('admin/sliders/'.$slider->id.'/edit') }}" class="btn btn-success btn-sm"> Edit </a> 
              <a href="{{ url('admin/sliders/'.$slider->id.'/delete') }}" onclick="return confirm('Are you sure want to delete this color ?')" class="btn btn-danger my-2 btn-sm">Delete</a>
              </td>
            </tr> 
            @empty 
            <tr><td colspan='7'> <h4 class="mb-3 p-2" style="color:red;text-align: center; padding-top:5px;">No Sliders Found</h4> </td></tr>
            @endforelse
          </table>
        </div>
     
        
      </div>
    </div>
  </div>


@endsection