<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', 'ClientController@index');
// Route::resource('client', 'ClientController');
// Route::resource('client/{client_id}/project', 'ProjectController');
// Route::resource('client/{client_id}/project/{project_id}/payment', 'PaymentController');
Route::get('/{any}', function() {
    return view('app');
})->where('any', '.*');

