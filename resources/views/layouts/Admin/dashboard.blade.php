@extends('layouts.admin')

@section('content')

@if(session('message'))
                <div class="card-body">
                {{ session('message') }}
                </div>
                @endif

@endsection