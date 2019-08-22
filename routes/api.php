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

/*|========================================================
 | Client
|========================================================*/

Route::get('/clients', 'Api\ClientsController@index');
Route::post('/client', 'Api\ClientsController@store');
Route::delete('/client/{client}', 'Api\ClientsController@destroy');

/*|========================================================
 | Client Project
|========================================================*/

Route::post('/client/{client}/project', 'Api\ClientProjectsController@store');


Route::get('/client/{$id}', 'Api\ClientsController@getClient');
// Route::middleware('api')->post('/client/{client_id}/project/{project_id}/payment', 'Api\PaymentsController@store');

/*|========================================================
 | Client Project Payments
|========================================================*/

Route::middleware('api')->post('/client/{client}/project/{project}/payment', 'Api\ClientProjectPaymentsController@store');
Route::middleware('api')->patch('/client/{client}/project/{project}/payment/{payment}', 'Api\ClientProjectPaymentsController@update');
