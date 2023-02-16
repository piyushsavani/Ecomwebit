@extends('layouts.admin.dashboard')

@section('content')

<form action="{{ url('admin/category')}}" method="post" enctype="multipart/form-data">
    @csrf
<div class="container">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label for="slug">slug</label>
            <input type="text" name="slug" class="form-control">
        </div>
        </div>

        <div class=" mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" rows="3"></textarea>
         
        </div>
        <div class="row">
        <div class="col-md-4 mb-3">
            <label for="meta_title">meta_title</label>
            <input type="text" name="meta_title" class="form-control">
        </div>
        <div class="col-md-4 mb-3">
            <label for="meta_keyword">meta_keyword</label>
            <input type="text" name="meta_keyword" class="form-control">
        </div>
        <div class="col-md-4 mb-3">
            <label for="status">status</label><br>
            <input type="checkbox" name="status" />
        </div>
        <div class="col-md-12 mb-3">
            <label for="meta_description">Meta Description</label>
            <textarea class="form-control" name="meta_description" rows="3"></textarea>
        </div>
        <div class="col-md-4 mb-3">
            <label for="image">Upload Image</label><br>
            <input type="file" name="image" />
        </div>

        <button class="btn btn-primary float-end">Submit</button>
    </div>
    </div>
</div>
</form>

@endsection


