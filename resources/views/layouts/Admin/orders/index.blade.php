@extends('layouts.admin.dashboard')

@section('title', 'My orders' )

@section('content')

<div class="py-3 py-md-4 checkout">
    <div class="container">

        <div class="py-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>My Order Information</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="get">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Filter By Date</label><br>
                                            <input type="date" name="date" class="form-control" value="{{ Request::get('date') ??date('Y-m-d') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Filter By Status</label>
                                            <select name="status" class="form-select">
                                                <option value="">Select All Status</option>
                                                <option value="in progress" {{Request::get('status') == 'in progress' ? 'selected':''}}>In Progress</option>
                                                <option value="return" {{Request::get('status') == 'return' ? 'selected':''}}>Return</option>
                                                <option value="completed" {{Request::get('status') == 'completed' ? 'selected':''}}>Completed</option>
                                                <option value="out for delivery" {{Request::get('status') == 'out for delivery' ? 'selected':''}}>Out For Delivefry</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <br>
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Tracking No.</th>
                                            <th>Payment mode </th>
                                            <th>Order Status</th>
                                            <th> Order Date </th>
                                            <th><a href="/admin/orders" class="btn btn-danger btn-sm float-right">
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
                                            <td><a href=" {{ url('admin/orders/'.$order->id) }} "
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

    @endsection