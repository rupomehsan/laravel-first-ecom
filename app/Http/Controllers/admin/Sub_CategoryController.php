<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
class Sub_CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategorys = SubCategory::all();
        return view('admin.product.subcategory.index',compact('subcategorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::all();
        return view('admin.product.subcategory.create',compact('categorys'));
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
            'category_id' => 'required'
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
        ];
      

        SubCategory::create($data);

        return response()->json([
            'status' => 'done',
            'message' => 'Successfully Category added'
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
        $subcategory = SubCategory::find($id);
        $categorys = Category::all();
        return view('admin.product.subcategory.edit',compact('categorys','subcategory'));
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
        $subcategory = SubCategory::where('id', $id)->first();

        $subcategory->name = request('name') ?? $subcategory->name;
        $subcategory->category_id = request('category_id') ?? $subcategory->category_id;
        $subcategory->update();
        return response()->json([
            'status' => 'done',
            'message' => 'Successfully sub_category updated '
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubCategory::find($id)->delete();
    }
}
