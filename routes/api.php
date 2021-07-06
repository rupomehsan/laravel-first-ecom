<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/sub-categories/{category_id}', [ApiController::class, 'sub_categories_by_category_id']);
Route::get('/districts/{division_id}', [ApiController::class, 'districts_by_division_id']);
Route::get('/stations/{district_id}', [ApiController::class, 'station_by_district_id']);