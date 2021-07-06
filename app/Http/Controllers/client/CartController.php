<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index()
    {
        $clientID = Cookie::get('client_id');
        $carts = Cart::where('client_id', $clientID)->get();
        return view('client.cart.index', compact('carts'));
    }

    public function store()
    {
        $clientID = Cookie::get('client_id');
        $cart = Cart::where('client_id',  $clientID)
            ->where('product_id', request('product_id'))
            ->first();

        if ($cart) {
            $cart->quantity = (int)$cart->quantity + (int)request('quantity');
            $cart->update();

            return response()->json([
                'status' => 'done',
                'message' => 'product quantity updated'
            ]);
        }

        Cart::create([
            'client_id' => $clientID,
            'product_id' => request('product_id'),
            'quantity' => request('quantity'),
            'price' => request('price'),
        ]);

        return response()->json([
            'status' => 'done',
            'message' => 'product add to cart'
        ]);
    }

    public function update($id)
    {
        $clientID = Cookie::get('client_id');

        $cart = Cart::where('client_id', $clientID)
            ->where('id', $id)
            ->first();

        $cart->quantity = (int)$cart->quantity + (int)request('quantity');
        $cart->update();

        return response()->json([
            'status' => 'done',
            'message' => 'product quantity updated'
        ]);
    }

    public function destroy($id)
    {
        $clientID = Cookie::get('client_id');
        Cart::where('client_id', $clientID)->where('id', $id)->first()->delete();

        return response()->json([
            'status' => 'done',
            'message' => 'Cart item deleted...'
        ]);
    }
}
