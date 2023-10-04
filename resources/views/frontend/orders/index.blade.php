@extends('layouts.app')

@section('title', 'My orders' )

@section('content')

<div class="py-3 py-md-4 checkout">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>My Order Information</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Tracking No.</th>
                                    <th>Payment mode </th>
                                    <th>Order Status</th>
                                    <th> Order Date </th>
                                    <th><a href="/orders" class="btn btn-danger btn-sm float-right">
                                            back
                                        </a>
                                    </th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->tracking_no }}</td>
                                    <td>{{ $order->payment_mode }}</td>
                                    <td>{{ $order->status_message }}</td>
                                    <td>{{ $order->created_at->format('d-m-Y h:m') }}</td>
                                    <td><a href=" {{ url('orders/'.$order->id) }} "
                                            class="btn btn-primary btn-sm float-right">
                                            view
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <div colspan="6"> No Orders Available </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>  
        </div>
    </div>
</div>
</div>

@endsection