@extends('layouts.app')

<!-- @section('title', 'category Page') -->
@section('meta_title', '{{ $category->meta_title }}')

@section('meta_description')
{{$category->meta_description}}
@endsection

@section('meta_keyword')
{{$category->meta_keyword}}
@endsection

@section('content')

<div class="py-3">

    <div class="container">
        <div class="col-md-12">
            <h4 class="mb-4">Our Products</h4>
            <livewire:frontend.product.index :category="$category" />
        </div>
    </div>
</div>


@endsection