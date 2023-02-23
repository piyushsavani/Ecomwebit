@extends('layouts.app')

@section('title', 'Cart Detail' )

@section('content')
<div class="container">

<div class="card">
    <div class="card-header">
        <h3> Cart Items</h3>
    </div>

        <livewire:frontend.cart-show /> 
   
    </div>
</div>

@endsection