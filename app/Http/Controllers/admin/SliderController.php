<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 
use Image;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
            'heading' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);
     
        if ($validate->fails()) {
            return response()->json([
                'status' => 'validation_error',
                'errors' => $validate->errors()
            ]);
        }

        $data = [
            'heading' => request('heading'),
            'title' => request('title'),
            'descripsion' => request('description'),
        ];
        // dd($data);

        $image_file = request()->file('image');

        if (!file_exists('uploads/sliders')) {
            $dir = mkdir('uploads/sliders');
        }

        if (request()->has('image')) {
            $image_url = 'uploads/sliders/' . Str::random(6) . '.' . $image_file->getClientOriginalExtension();
            Image::make($image_file)->save($image_url, 80);
            $data['image'] = $image_url;
        }
        Slider::create($data);

        return response()->json([
            'status' => 'done',
            'message' => 'Successfully Slider added'
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
        $slider = Slider::find($id);
        return view('admin.slider.edit',compact('slider'));
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
        $slider = Slider::where('id', $id)->first();

        $slider->heading = request('heading') ?? $slider->heading;
        $slider->title = request('title') ?? $slider->title;
        $slider->descripsion = request('description') ?? $slider->descripsion;
     

        $image_file= request()->file('image');
  

        if (!file_exists('uploads/sliders')) {
            $dir = mkdir('uploads/sliders');
        }

        if (request()->has('image')) {
            $image_url = 'uploads/sliders/' . Str::random(6) . '.' . $image_file->getClientOriginalExtension();
            Image::make($image_file)->save($image_url, 80);
            $slider->image = $image_url;
        }

     
        $slider->update();
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
        Slider::find($id)->delete();
    }
}
