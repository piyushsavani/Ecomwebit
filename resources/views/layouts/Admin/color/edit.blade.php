@extends('layouts.admin.dashboard')

@section('content')
@if(session()->get('errors'))
toastr.error("{{ session()->get('errors')->first() }}");
@endif

<form action="{{ url('admin/color/'.$colors->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="container">
        <table class="table-bordered mb-3">
            <h3 style="color: blue;"><b> Edit color</b></h3>
        </table>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="name">Color Name</label>
                <input type="text" value="{{$colors->color_name}}" name="color_name" class="form-control" />
            </div>
            <div class="col-md-4 mb-3">
                <label for="slug">Color code</label>
                <input type="text" value="{{$colors->color_code}}" name="color_code" class="form-control" />
            </div>
            <div class="col-md-3 mb-3">
                <label>Status</label><br />
                <input type="checkbox" value="{{$colors->status == 1 ? 'checked':''}}" name="status" />
            </div>
        </div>
        <br/>

        <button class="btn btn-primary">Update color</button>
    </div>
</form>

@endsection