@extends('layouts.admin.dashboard')

@section('title', 'My orders Details' )

@section('content')

<div class="py-3 py-md-4 checkout">
    <div class="container">
        @if(session('message'))
        <div class="alert-alert-success" style="color:green;"> {{ session('message') }} </div>
        @endif
        <div class="card mt-3">
            <div class="card-header">
                <div class="row">
                <h4 style="color:blue;"> Order Detailed Information
                <span class="float-right">
                    <a type="button" href="{{ url('/admin/order/'.$order->id) }}" target="_blank" class="btn btn-success mx-2">
                    View Invoice
                    </a>
                    <a type="button" href="{{ url('/admin/order/'.$order->id.'/generate') }}" class="btn btn-primary mx-2">
                        Download Invoice
                    </a>
                    <a type="button" href="{{ url('/admin/orders') }}" class="btn btn-danger mx-2">
                        Back
                    </a>
            </span>
            </h4>
            </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 style="color:orange;">Order details </h5>
                        <hr>
                        <h6>Order ID - {{ $order->id }} </h6>
                        <h6>Tracking No. - {{ $order->tracking_no }} </h6>
                        <h6>Payment mode - {{ $order->payment_mode }} </h6>
                        <h6>Order Date - {{ $order->created_at->format('d-m-Y h:m') }} </h6>
                        <h6>Order Status - {{ $order->status_message }} </h6>
                    </div>
                    <div class="col-md-6">
                        <h5 style="color:orange;">User details </h5>
                        <hr>
                        <h6>Full name - {{ $order->fullname }} </h6>
                        <h6>Email - {{ $order->email }} </h6>
                        <h6>Phone No - {{ $order->phone }} </h6>
                        <h6>Address - {{ $order->address }} </h6>
                        <h6>Pincode - {{ $order->piincode }} </h6>
                    </div>
                </div>
                <hr>

                <h4 style="color:blue;"> My Order Items </h4>
                <div class="table-responsive">
                    <table class="table table-borderd table-striped">
                        <thead>
                            <tr style="color:green;">
                                <th> Item </th>
                                <th> Image </th>
                                <th> Quntity </th>
                                <th> Price Per Peace</th>
                                <th> Total Price </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totlaAmount = 0; @endphp
                            @foreach($order->orderItems as $orderItem)
                            <tr>
                                <td>{{$orderItem->product->product_name}}
                                    @if($orderItem->orderItemColor)
                                    - {{ $orderItem->orderItemColor->colors->color_name}}
                                    @endif
                                </td>
                                @if($orderItem->product->productImages)
                                <td style="width:30%"><img
                                        src="{{ asset($orderItem->product->productImages[0]->image) }}" alt="NoImg"
                                        style="width:10%; height:10%;"></td>
                                @endif
                                <td>{{$orderItem->quantity}}</td>
                                <td>{{$orderItem->price}}</td>
                                <td>{{$orderItem->price * $orderItem->quantity}}</td>
                                @php $totlaAmount += $orderItem->price * $orderItem->quantity @endphp
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7">
                            </div>
                            <div class="col-md-5">
                                <h4 class="float-right mx-5" style="color:blue;" colspan="5"> Total Amount : <span
                                        style="color:green;" class="mx-2 float-right"> {{ $totlaAmount }} </span></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{url('/admin/orders/'.$order->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label> Update The Order Status</label>
                                    <select name="status" class="form-select">
                                        <option value="">Select All Status</option>
                                        <option value="in progress" {{Request::get('status')=='in progress' ? 'selected'
                                            :''}}>
                                            In Progress</option>
                                        <option value="return" {{Request::get('status')=='return' ? 'selected' :''}}>
                                            Return
                                        </option>
                                        <option value="completed" {{Request::get('status')=='completed' ? 'selected'
                                            :''}}>
                                            Completed</option>
                                        <option value="out for delivery" {{Request::get('status')=='out for delivery'
                                            ? 'selected' :''}}>Out For Delivefry</option>
                                    </select>
                                </div>
                                <div class="col-md-8"><br>
                                    <div class="row">
                                        <div class="col-md-6">                                        
                                        <button type="submit" class="btn btn-success">Update Order Status</button>
                                    </div>
                                        <div class="col-md-6 float-left">
                                            Current Order Status is <b><span style="color:orange;">{{ $order->status_message }} </span></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

@endsection