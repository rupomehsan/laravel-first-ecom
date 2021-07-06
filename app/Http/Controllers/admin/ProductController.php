<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(19);
        return view('admin.product.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::all();
        $brands = Brand::all();
       
        return view('admin.product.products.create',compact('categorys','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $validate = Validator::make(request()->all(), [
            'name' => 'required|min:3',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'brand_id' => 'required',
            'description' => 'required'
        ]);
     
        if ($validate->fails()) {
            return response()->json([
                'status' => 'validation_error',
                'errors' => $validate->errors()
            ]);
        }

        $data = [
            'name' => request('name'),
            'category_id' => request('category_id'),
            'sub_category_id' => request('sub_category_id'),
            'brand_id' => request('brand_id'),
            'price' => request('price'),
            'description' => request('description'),
            'stock' => request('stock'),
            'tags' => request('tags'),
            'code' => request('code'),
            'promo_code_id' => request('promo_code'),
            'product_type' => request('product_type'),
        ];
        // dd($data);
    

        $image_file_1 = request()->file('image_1');
        $image_file_2 = request()->file('image_2');
        $image_file_3 = request()->file('image_3');
        $image_file_4 = request()->file('image_4');

        if (!file_exists('uploads/products')) {
            $dir = mkdir('uploads/products');
        }

        if (request()->has('image_1')) {
            $image_url = 'uploads/products/' . Str::random(6) . '.' . $image_file_1->getClientOriginalExtension();
            Image::make($image_file_1)->save($image_url, 80);
            $data['image_1'] = $image_url;
        }

        if (request()->has('image_2')) {
            $image_url = 'uploads/products/' . Str::random(6) . '.' . $image_file_2->getClientOriginalExtension();
            Image::make($image_file_2)->save($image_url, 80);
            $data['image_2'] = $image_url;
        }

        if (request()->has('image_3')) {
            $image_url = 'uploads/products/' . Str::random(6) . '.' . $image_file_3->getClientOriginalExtension();
            Image::make($image_file_3)->save($image_url, 80);
            $data['image_3'] = $image_url;
        }

        if (request()->has('image_4')) {
            $image_url = 'uploads/products/' . Str::random(6) . '.' . $image_file_4->getClientOriginalExtension();
            Image::make($image_file_4)->save($image_url, 80);
            $data['image_4'] = $image_url;
        }

        Product::create($data);

        return response()->json([
            'status' => 'done',
            'message' => 'Successfully product added'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categorys = Category::all();
        $brands = Brand::all();
        return view('admin.product.products.edit', compact('product', 'categorys', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();

        $product->name = request('name') ?? $product->name;
        $product->category_id = request('category_id') ?? $product->category_id;
        $product->sub_category_id = request('sub_category_id') ?? $product->sub_category_id;
        $product->price = request('price') ?? $product->price;
        $product->brand_id = request('brand_id') ?? $product->brand_id;
        $product->description = request('description') ?? $product->description;
        $product->stock = request('stock') ?? $product->stock;
        $product->tags = request('tags') ?? $product->tags;
        $product->code = request('code');
        $product->product_type = request('product_type') ?? $product->product_type;
        $product->activity = request('activity') ?? $product->activity;
        $product->promo_code_id = request('promo_code') ?? $product->promo_code;

        $image_file_1 = request()->file('image_1');
        $image_file_2 = request()->file('image_2');
        $image_file_3 = request()->file('image_3');
        $image_file_4 = request()->file('image_4');

        if (!file_exists('uploads/products')) {
            $dir = mkdir('uploads/products');
        }

        if ($image_file_1) {
            $image_url = 'uploads/products/' . Str::random(6) . '.' . $image_file_1->getClientOriginalExtension();
            Image::make($image_file_1)->save($image_url, 80);
            $product->image_1 = $image_url;
        }

        if ($image_file_2) {
            $image_url = 'uploads/products/' . Str::random(6) . '.' . $image_file_2->getClientOriginalExtension();
            Image::make($image_file_2)->save($image_url, 80);
            $product->image_2 = $image_url;
        }

        if ($image_file_3) {
            $image_url = 'uploads/products/' . Str::random(6) . '.' . $image_file_3->getClientOriginalExtension();
            Image::make($image_file_3)->save($image_url, 80);
            $product->image_3 = $image_url;
        }

        if ($image_file_4) {
            $image_url = 'uploads/products/' . Str::random(6) . '.' . $image_file_4->getClientOriginalExtension();
            Image::make($image_file_4)->save($image_url, 80);
            $product->image_4 = $image_url;
        }

        $product->update();
        return response()->json([
            'status' => 'done',
            'message' => 'Successfully product updated '
        ]);
        // return redirect()->back()->with('message', 'Successfully product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return response()->json([
            'status' => 'done',
            'message' => 'Successfully Product delete '
        ]);
    }
}
