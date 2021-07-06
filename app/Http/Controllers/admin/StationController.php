<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Station;
use App\Models\Division;
use App\Models\District;
use Illuminate\Support\Facades\Validator;
class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::paginate(20);
        return view('admin.location.station.index',compact('stations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('admin.location.station.create',compact('divisions'));
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
            'district_id' => 'required'
        ]);
     
        if ($validate->fails()) {
            return response()->json([
                'status' => 'validation_error',
                'errors' => $validate->errors()
            ]);
        }

        $data = [
            'name' => request('name'),
            'district_id' => request('district_id'),
            'code' => strtoupper(uniqid('STA_')),
        ];
      

        Station::create($data);

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
        $station = Station::find($id);
        $divisions = Division::all();
        $districts = District::all();
        return view('admin.location.station.edit', compact('station', 'divisions', 'districts'));
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
        $station = Station::where('id', $id)->first();
        $station->name = request('name') ?? $station->name;
        $station->district_id = request('district_id') ?? $station->district_id;
        
        $station->update();
        return response()->json([
            'status' => 'done',
            'message' => 'Successfully Division updated '
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
        Station::find($id)->delete();
    }
}
