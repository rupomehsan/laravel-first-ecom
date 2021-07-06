<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Division;
use App\Models\Disruct;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    public function index(){
        $clientID = Cookie::get('client_id');
        $carts = Cart::where('client_id', $clientID)->get();
        $divisions = Division::all();
        return view('client.checkout.checkout', compact('carts','divisions'));
    }
}
