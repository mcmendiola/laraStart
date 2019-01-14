<?php

use Illuminate\Http\Request;

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

Route::apiResources(['user' => 'API\UserController']);
Route::get('profile', 'API\UserController@profile');
Route::put('profile', 'API\UserController@updateProfile');
Route::apiResources(['sqltest' => 'API\SqlTestController']);
Route::get('dBInfo', 'API\SqlTestController@getDBInfo');
Route::apiResources(['showreport' => 'API\ReportController']);

Route::get('/showreportRpt/jrpt/{id}/{vdtime}', 'API\ReportController@jrpt');

/*Route::middleware('auth:api')->get('/sqltest', function () {
    $name = DB::Connection()->getDatabaseName();
    return 'Connected to ' .$name;
});*/


