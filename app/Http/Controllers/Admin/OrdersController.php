<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        // $selectedDate = $request->date; 
        // $orders = Order::whereDate('created_at', $selectedDate)->get();
        $orders = Order::when($request->date != NULL, function ($q) use($request) {
            return $q->whereDate('created_at', $request->date);
        }, function($q) use($todayDate){
            return $q->whereDate('created_at', $todayDate);
        })
           ->when($request->status != NULL, function($q) use($request){
             return $q->where('status_message', $request->status);
           })->get();

        return view('layouts.admin.orders.index', compact('orders'));
    }

    public function show($orderId)
    {
        $order = Order::where('id', $orderId)->first();
        return view('layouts.admin.orders.view', compact('order'));
    }
    public function update(Request $request, int $orderId)
    {
        $order = Order::where('id', $orderId)->first();
        if($order){
            $order->update([
                'status_message' => $request->status
            ]);
            return redirect('admin/orders/'.$orderId)->with('message', 'Order Updated Successfully');
        } else {
            return redirect()->back()->with('message', 'Order Updated Successfully');
        }
    }

    public function viewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('layouts.admin.invoice.generate-invoice', compact('order'));
    }

    public function downloadInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];
        $pdf = Pdf::loadView('layouts.admin.invoice.generate-invoice', $data);
        return $pdf->download('invoice-'.$orderId.'-'.$order->created_at.'.pdf');

    }
}
