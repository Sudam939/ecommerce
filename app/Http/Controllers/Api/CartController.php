<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\CartResponseResource;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_cart(Request $request)
    {
        $cart = new Cart();
        $cart->customer_id = Auth::user()->id;
        $cart->product_id = $request->product_id;
        $cart->qty = $request->qty;
        $cart->total = $request->qty * $request->price;
        $cart->save();
        return CartResponseResource::make([
            'success' => true,
            'message' => "Item added to cart"
        ]);
    }

    public function get_cart()
    {
        $carts = Cart::where('customer_id', Auth::user()->id)->get();
        return CartResource::collection($carts);
    }

    public function delete_cart(string $id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return CartResponseResource::make([
            'success' => true,
            'message' => "Item deleted from cart"
        ]);
    }
}
