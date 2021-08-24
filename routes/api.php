<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// its the routing for the two api //


Route::post('/insert_token', 'App\Http\Controllers\TokenController@store');
Route::post('/insert_campaign', 'App\Http\Controllers\CampaignController@store');

Route::get('/get/{$companyName}', 'App\Http\Controllers\ShowController@show');
Route::post('/practice', 'App\Http\Controllers\PracticeController@check');



Route::resource('learning', 'App\Http\Controllers\LearnController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
