<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\District;
use App\Models\Station;
class ApiController extends Controller
{
    public function sub_categories_by_category_id($category_id)
    {
        $subCategories = SubCategory::where('category_id', $category_id)->get();

        return response([
            'status' => 'done',
            'subCategories' => $subCategories
        ]);
    }

    public function districts_by_division_id($division_id)
    {
        $districts = District::where('division_id', $division_id)->get();

        return response([
            'status' => 'done',
            'districts' => $districts
        ]);
    }
    public function station_by_district_id($district_id)
    {
        $stations = Station::where('district_id', $district_id)->get();

        return response([
            'status' => 'done',
            'stations' => $stations
        ]);
    }
}
