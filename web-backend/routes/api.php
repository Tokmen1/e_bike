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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('ebike')->group(function () {
    Route::get('/', 'App\Http\Controllers\EbikeController@index');
    Route::get('/create', 'App\Http\Controllers\EbikeController@create');
    Route::post('/', 'App\Http\Controllers\EbikeController@store');
    Route::get('{ebike}', 'App\Http\Controllers\EbikeController@show');
    Route::get('{ebike}/edit', 'App\Http\Controllers\EbikeController@edit');
    Route::put('{ebike}', 'App\Http\Controllers\EbikeController@update');
    Route::delete('{ebike}', 'App\Http\Controllers\EbikeController@delete');
});

Route::prefix('employee')->group(function () {
    Route::get('/', 'App\Http\Controllers\EmployeeController@index');
    Route::get('/create', 'App\Http\Controllers\EmployeeController@create');
    Route::post('/', 'App\Http\Controllers\EmployeeController@store');
    Route::get('{employee}', 'App\Http\Controllers\EmployeeController@show');
    Route::get('{employee}/edit', 'App\Http\Controllers\EmployeeController@edit');
    Route::put('{employee}', 'App\Http\Controllers\EmployeeController@update');
    Route::delete('{employee}', 'App\Http\Controllers\EmployeeController@delete');
});

Route::prefix('employeeEBike')->group(function () {
    Route::get('/', 'App\Http\Controllers\EmployeeEBikeController@index');
    Route::get('/create', 'App\Http\Controllers\EmployeeEBikeController@create');
    Route::post('/', 'App\Http\Controllers\EmployeeEBikeController@store');
    Route::get('{employeeEBike}', 'App\Http\Controllers\EmployeeEBikeController@show');
    Route::get('{employeeEBike}/edit', 'App\Http\Controllers\EmployeeEBikeController@edit');
    Route::put('{employeeEBike}', 'App\Http\Controllers\EmployeeEBikeController@update');
    Route::delete('{employeeEBike}', 'App\Http\Controllers\EmployeeEBikeController@delete');
});
