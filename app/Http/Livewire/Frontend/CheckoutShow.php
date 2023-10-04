<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use App\Models\frontend\Cart;

class CheckoutShow extends Component
{
    public $cart, $price, $fullname, $phone, $email, $pincode, $address, $payment_mode;

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:191',
            'phone' => 'required|string|max:11|min:10',
            'email' => 'required|email|max:50',
            'pincode' => 'required|string|max:6',
            'address' => 'required|string|max:191',
        ];
    }

    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
                    'user_id' => auth()->user()->id,
                    'tracking_no' => 'akshar'.Str::random(10),
                    'fullname' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'phone' => $this->phone,
                    'pincode' => $this->pincode,
                    'address' => $this->address,
                    'status_message' => 'in progress',
                    'payment_mode' => $this->payment_mode,
                ]);

        foreach($this->cart as $cartItem)  
        {              
            $orderItems = OrderItem::create([            
                    'order_id' => $order->id,
                    'product_id' => $cartItem->products->id,
                    'product_color_id' => $cartItem->color_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                ]);    
                

        if($cartItem->color_id != NULL) {
            $cartItem->ProductColors()->where('id', $cartItem->color_id)->decrement('quantity',$cartItem->quantity);
        } else {
            $cartItem->products()->where('id', $cartItem->product_id)->decrement('qauntity',$cartItem->quantity);
        }
    }
        session()->flash('message','Your Order Placed Successfully');
        return $orderItems;
    }

    public function codOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $orderItems = $this->placeOrder();
        if ($orderItems) {
            Cart::where('user_id', auth()->user()->id)->delete();
            return redirect()->to('/thank-you');
        }        
    }

    public function totalPrice()
    {
        $this->price = 0;
        foreach($this->cart as $cartItem)
        {
            $this->price += $cartItem->price*$cartItem->quantity;
        }

        return $this->price;
    }

    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->cart = Cart::where('user_id', auth()->user()->id)->get();       
        $this->price = $this->totalPrice(); 
        return view('livewire.frontend.checkout-show', [
            'cart' => $this->cart, 
            'price' =>$this->price,                    
        ]);
    }
}
