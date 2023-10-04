@extends('layouts.app')

@section('title', 'New Arrivals')

@section('content')

<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">New Arrivals</h4>
            </div>

            @forelse($newArrivals as $categoryItem)
            <div class="col-6 col-md-3">
                <div class="category-card">
                    <a href="{{ url('/collections/'.$categoryItem->slug) }}">
                        <div class="category-card-img">
                            <img src="{{ asset($categoryItem->productImages[0]->image) }}" class="w-100 img-fluid" alt="Laptop">
                        </div>
                        <div class="category-card-body">
                            <h5>{{$categoryItem->name}}</h5>
                        </div>
                        <div class="container">
                            <p>{{$categoryItem->description}}</p>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-6 col-md-3">
                <div class="category-card">
                    <h3> No New Arrivals Found</h3>
                </div>
            </div>
            @endforelse

        </div>
    </div>
</div>


@endsection