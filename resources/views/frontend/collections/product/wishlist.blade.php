@extends('layouts.app')

@section('title', 'Product Detail' )

@section('content')
<div class="container">

<div class="card">
    <div class="card-header">
        <h3> Your Wishlist are as Below</h3>
    </div>

    <livewire:frontend.wishlist-show />
   
</div>
</div>

@endsection