<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function order_history()
    {
        $orders = Order::where('user_id',Auth::user()->id)->first();
        return OrderResource::collection($orders);
    }

    public function post_order(Request $request)
    {
        $order = new Order();
        $order->customer_id = Auth::user()->id;
        $order->total = $request->total;
        $order->status = "pending";
        $order->save();

        foreach ($request->orderDescriptions as $item) {
            $orderLine = new OrderLine();
            $orderLine->order_id = $order->id;
            $orderLine->product_id = $item['product_id'];
            $orderLine->qty = $item['qty'];
            $orderLine->amount = $item['amount'];
            $orderLine->save();
        }

        $carts = Cart::where("customer_id", Auth::user()->id)->get();
        foreach ($carts as $cart) {
            $cart->delete();
        }

        return OrderResource::make([
            "success" => true,
            "message" => "Your order has been placed"
        ]);
    }
}
