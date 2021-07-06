<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::with('sub_categories')->get(); 
        return view('admin.product.category.index',compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.category.create');
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
        ]);
     
        if ($validate->fails()) {
            return response()->json([
                'status' => 'validation_error',
                'errors' => $validate->errors()
            ]);
        }

        $data = [
            'name' => request('name'),
        ];
      

        Category::create($data);


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
      
        $category = Category::find($id);
        return view('admin.product.category.edit', compact('category'));
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
        $category = Category::where('id', $id)->first();

        $category->name = request('name') ?? $category->name;
        
        
        $category->update();
        return response()->json([
            'status' => 'done',
            'message' => 'Successfully product updated '
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
        Category::find($id)->delete();
        return response()->json([
            'status' => 'done',
            'message' => 'Successfully Product delete '
        ]);
    }
}
