<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sitesetting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 
use Image;

class SitesettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $sitesetting = Sitesetting::first();
        if ($sitesetting) {
            return view('admin.sitesetting.edit',compact('sitesetting'));
        }

        return view('admin.sitesetting.create');
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
            'title' => 'required|min:3',
            'email' => 'required',
            'phone' => 'required',
            'copyright' => 'required',
            'address' => 'required',
        ]);
     
        if ($validate->fails()) {
            return response()->json([
                'status' => 'validation_error',
                'errors' => $validate->errors()
            ]);
        }

        $data = [
            'title' => request('title'),
            'email' => request('email'),
            'phone' => request('phone'),
            'copyright' => request('copyright'),
            'address' => request('address'),
            'fb_link' => request('	fb_link'),
            'twitter_link' => request('twitter_link'),
            'youtube_link' => request('youtube_link'),
        ];

        $image_file = request()->file('site_logo');
     
        if (!file_exists('uploads/settings')) {
            $dir = mkdir('uploads/settings');
        }

        if (request()->has('site_logo')) {
            $image_url = 'uploads/settings/' . Str::random(6) . '.' . $image_file->getClientOriginalExtension();
            Image::make($image_file)->save($image_url, 80);
            $data['logo'] = $image_url;
        }

        Sitesetting::create($data);

        return response()->json([
            'status' => 'done',
            'message' => 'Successfully product added'
        ]);
    }

    public function update(Request $request, $id)
    {
        $sitesetting = Sitesetting::where('id', 1)->first();

        $sitesetting->title = request('title') ?? $sitesetting->title;
        $sitesetting->email = request('email') ?? $sitesetting->email;
        $sitesetting->phone = request('phone') ?? $sitesetting->phone;
        $sitesetting->copyright = request('copyright') ?? $sitesetting->copyright;
        $sitesetting->address = request('address') ?? $sitesetting->address;
        $sitesetting->fb_link = request('fb_link') ?? $sitesetting->fb_link;
        $sitesetting->twitter_link = request('twitter_link') ?? $sitesetting->twitter_link;
        $sitesetting->youtube_link = request('youtube_link') ?? $sitesetting->youtube_link;
      

        $image_file = request()->file('site_logo');
     
        if (!file_exists('uploads/settings')) {
            $dir = mkdir('uploads/settings');
        }

        if (request()->has('site_logo')) {
            $image_url = 'uploads/settings/' . Str::random(6) . '.' . $image_file->getClientOriginalExtension();
            Image::make($image_file)->save($image_url, 80);
            $sitesetting['logo'] = $image_url;
        }

        $sitesetting->update();
        return response()->json([
            'status' => 'done',
            'message' => 'Successfully product updated '
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
        $sitesetting = Sitesetting::where('id',1)->first();
        return view('admin.sitesetting.edit',compact('sitesetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
