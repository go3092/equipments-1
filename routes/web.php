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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
//home
Route::get('/home', 'HomeController@index')->name('home');
//profile
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::post('/profile', 'HomeController@update_profile')->name('profile');

//complaint
Route::get('/complaint', 'ComplaintController@index')->name('complaint');
Route::get('/complaint/create-new', 'ComplaintController@create_page')->name('complaint');
Route::post('/complaint/create-new', 'ComplaintController@create_save')->name('complaint');
Route::get('/complaint/update/{complaint}', 'ComplaintController@update_page')->name('complaint');
Route::post('/complaint/update/{complaint}', 'ComplaintController@update_save')->name('complaint');
Route::delete('/complaint/delete/{complaint}', 'ComplaintController@delete')->name('complaint');
Route::get('/complaint/report/', 'ComplaintController@report')->name('complaint');
Route::get('/complaint/report/excel', 'ComplaintController@excel')->name('complaint');

//report admin manager
Route::group(['middleware' => 'manager','admin'], function () {
  //report complaints for admin and manager
  Route::get('report/rcomplaint', 'Report\RcomplaintsController@index');
  Route::get('report/rcomplaint/excel', 'Report\RcomplaintsController@excel');
});

//for superviso or admin
Route::group(['middleware' => 'supervisor'], function () {
  //level
  Route::get('/level', 'LevelsController@index')->name('level');
  Route::get('/level/create-new', 'LevelsController@create_page')->name('level');
  Route::post('/level/create-new', 'LevelsController@create_save')->name('level');
  Route::get('/level/update/{level}', 'LevelsController@update_page')->name('level');
  Route::post('/level/update/{level}', 'LevelsController@update_save')->name('level');
  Route::delete('/level/delete/{level}', 'LevelsController@delete')->name('level');
  //funloc
  Route::get('/funloc', 'FunlocController@index')->name('funloc');
  Route::get('/funloc/create-new', 'FunlocController@create_page')->name('funloc');
  Route::post('/funloc/create-new', 'FunlocController@save_create')->name('funloc');
  Route::get('/funloc/update/{funloc}', 'FunlocController@update_page')->name('funloc');
  Route::post('/funloc/update/{funloc}', 'FunlocController@update_save')->name('funloc');
  Route::delete('/funloc/delete/{funloc}', 'FunlocController@delete')->name('funloc');
  //equipment
  Route::get('/equipments', 'EquipmentsController@index')->name('equipment');
  Route::get('/equipments/create-new', 'EquipmentsController@create_page')->name('equipment');
  Route::post('/equipments/create-new', 'EquipmentsController@save_create')->name('equipment');
  Route::get('/equipments/update/{equipment}', 'EquipmentsController@update_page')->name('equipment');
  Route::post('/equipments/update/{equipment}', 'EquipmentsController@update_save')->name('equipment');
  Route::post('/equipments/update-details/', 'EquipmentsController@update_details')->name('equipment');
  Route::post('/equipments/delete-details/', 'EquipmentsController@delete_details')->name('equipment');
  Route::get('/equipments/create-details/{equipment}', 'EquipmentsController@create_details')->name('equipment');
  Route::post('/equipments/create-details/{equipment}', 'EquipmentsController@save_details')->name('equipment');

  //workplane
  Route::get('/workplane', 'WorkplaneController@index')->name('complaint');
  Route::get('/workplane/create-new/{equdet}', 'WorkplaneController@create_page')->name('workplan');
  Route::post('/workplane/create-new/{equdet}', 'WorkplaneController@create_save')->name('workplan');
  Route::get('/workplane/update/{workplan}', 'WorkplaneController@update_page')->name('workplan');
  Route::post('/workplane/update/{workplan}', 'WorkplaneController@update_save')->name('workplan');
  Route::delete('/workplane/delete/{workplan}', 'WorkplaneController@delete')->name('workplan');
  Route::get('/workplane/report/', 'WorkplaneController@report')->name('workplan');
  Route::get('/workplane/report/excel', 'WorkplaneController@excel')->name('workplan');

  //energys Using
  Route::get('/energys', 'EnergysController@index')->name('energys');
  Route::get('/energys/create-new', 'EnergysController@create_page')->name('energys');
  Route::post('/energys/create-new', 'EnergysController@create_save')->name('energys');
  Route::get('/energys/update/{energys}', 'EnergysController@update_page')->name('energys');
  Route::post('/energys/update/{energys}', 'EnergysController@update_save')->name('energys');
  Route::delete('/energys/delete/{energys}', 'EnergysController@delete')->name('energys');
  Route::get('/energys/report/', 'EnergysController@report')->name('energys');
  Route::get('/energys/report/excel', 'EnergysController@excel')->name('energys');
});



  //for admin
  Route::group(['middleware' => 'admin'], function () {
    //users
    Route::get('master/users/', 'UsersController@index');
    Route::get('master/users/create-new', 'UsersController@create_page');
    Route::post('master/users/create-new', 'UsersController@save_page');
    Route::get('master/users/update/{user}', 'UsersController@update_page');
    Route::post('master/users/update/{user}', 'UsersController@update_save');
    Route::delete('master/users/delete/{user}', 'UsersController@delete');

    //reset password
    Route::post('master/users/reset-password/{user}', 'UsersController@reset_password');

    //Items
    Route::get('master/item/', 'Master\ItemsController@index');
    Route::get('master/item/create-new', 'Master\ItemsController@create_page');
    Route::post('master/item/create-new', 'Master\ItemsController@save_create');
    Route::get('master/item/update/{item}', 'Master\ItemsController@update_page');
    Route::post('master/item/update/{item}', 'Master\ItemsController@update_save');
    Route::delete('master/item/delete/{item}', 'Master\ItemsController@delete');
    //approvals
    Route::get('approvals/', 'ApprovalsController@index');
    Route::get('approvals/show/{approval}', 'ApprovalsController@show');
    Route::post('approvals/update/{approval}', 'ApprovalsController@update_approvals');
    //report workplan for admin
    Route::get('report/rworkplane', 'Report\RworkplansController@index');
    Route::get('report/rworkplane/excel', 'Report\RworkplansController@excel');

    //report energys using for admin
    Route::get('report/renergys', 'Report\RenergysController@index');
    Route::get('report/renergys/excel', 'Report\RenergysController@excel');

});
