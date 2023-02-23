@extends('layouts.app')

@section('title', 'Thank you' )

@section('content')

<div class="py-3 py-md-4 checkout">
        <div class="container shadow text-center">
            @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <h2 class="my-4">Your Logo </h2>
            <h4 class="my-4" style="color:green">Thank you for Shopping with us</h4>
            <a class="btn btn-primary mb-5" href="{{ url('/collections') }}"> Go For more shopping</a>
        </div>
    </div>

@endsection