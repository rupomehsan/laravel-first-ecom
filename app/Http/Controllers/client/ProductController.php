<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function product(){
        $products = Product::where('status','active')->paginate(12);
        $categories = Category::where('status', 'active')->get();
        $brands = Brand::withCount(['products'])->where('status', 'active')->limit(10)->get();
        return view('client.product.product',compact('categories','brands','products'));
    }

    public function productdetailse($id){
        $genCookie = !Cookie::has('client_id')
            ? Cookie::queue('client_id', 'client_' . request()->ip(), 60)
            : '';

        $categories = Category::where('status', 'active')->get();
        $brands = Brand::withCount(['products'])->where('status', 'active')->limit(10)->get();
        $product = Product::find($id);
        return view('client.product.productdetailse',compact('product','categories','brands'));
    }

}
