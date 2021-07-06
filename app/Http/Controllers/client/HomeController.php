<?php
namespace App\Http\Controllers\client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index(){

        $featuredProducts = Product::where('status', 'active')
        ->where('product_type', 'Featured')
        ->orderBy('id', 'desc')
        ->limit(6)
        ->get();
        $recommendedProducts = Product::where('status', 'active')
        ->where('product_type', 'Recommonded')
        ->orderBy('id', 'desc')
        ->limit(6)
        ->get();
        $categories = Category::where('status', 'active')->get();
        $sliders = Slider::where('status', 'active')->get();
        $brands = Brand::withCount(['products'])->where('status', 'active')->limit(10)->get();
        return view('client.home.index',compact('categories','brands','featuredProducts','recommendedProducts','sliders'));
        
    }
    
}
