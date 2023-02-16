@extends('layouts.admin.dashboard')

@section('content')
@if(session()->get('errors'))
toastr.error("{{ session()->get('errors')->first() }}");
@endif

<form action="{{ url('admin/colors')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="container">
        <table class="table-bordered mb-3">
            <h3 style="color: blue;"><b> Add color</b></h3>
        </table>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="name">Color Name</label>
                <input type="text" name="color_name" class="form-control" />
            </div>
            <div class="col-md-4 mb-3">
                <label for="slug">Color code</label>
                <input type="text" name="color_code" class="form-control" />
            </div>
            <div class="col-md-3 mb-3">
                <label>Status</label><br />
                <input type="checkbox" name="status" />
            </div>
        </div>
        <br/>

        <button class="btn btn-primary">Submit</button>
    </div>
</form>

@endsection