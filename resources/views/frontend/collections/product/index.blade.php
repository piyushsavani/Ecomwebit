@extends('layouts.app')

@section('title', 'Product Detail' )

@section('content')

<div class="py-3 py-md-5 bg-light">
        <div class="container">
            <livewire:frontend.product.view :product="$product" :category="$category" />
        </div>
    </div>

@endsection