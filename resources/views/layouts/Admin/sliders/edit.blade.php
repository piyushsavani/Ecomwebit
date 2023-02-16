@extends('layouts.admin.dashboard')

@section('content')
@if(session()->get('errors'))
toastr.error("{{ session()->get('errors')->first() }}");
@endif
<div>
<form action="{{ url('admin/sliders/'.$slider->id.'/edit') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container">
        <table class="table-bordered mb-3">
            <h3 style="color: blue;"><b> Edit Slider</b></h3>
        </table>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="name">Slider Title</label>
                <input type="text" name="title" value="{{$slider->title}}" class="form-control" />
            </div>
            <div class="col-md-4 mb-3">
                <label >Description</label>
                <input type="text" name="description" value="{{$slider->description}}" class="form-control" />
            </div>
            <div class="col-md-3 mb-3">
                <label>Image</label><br/>
                <input type="file"  name="image"/>
                <img src="{{ asset("$slider->image") }}" class="mt-2" style="width:80px; height:80px;" alt="">
            </div>
        </div>
        <br/>

        <button class="btn btn-primary">Update</button>
    </div>
</form>
</div>

@endsection