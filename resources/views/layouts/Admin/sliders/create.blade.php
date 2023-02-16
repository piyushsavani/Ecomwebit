@extends('layouts.admin.dashboard')

@section('content')
@if(session()->get('errors'))
toastr.error("{{ session()->get('errors')->first() }}");
@endif

<form action="{{ url('admin/sliders')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="container">
        <table class="table-bordered mb-3">
            <h3 style="color: blue;"><b> Add Slider</b></h3>
        </table>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="name">Slider Title</label>
                <input type="text" name="title" class="form-control" />
            </div>
            <div class="col-md-4 mb-3">
                <label >Description</label>
                <input type="text" name="description" class="form-control" />
            </div>
            <div class="col-md-3 mb-3">
                <label>Image</label><br />
                <input type="file" name="image" />
            </div>
        </div>
        <br/>

        <button class="btn btn-primary">Submit</button>
    </div>
</form>

@endsection