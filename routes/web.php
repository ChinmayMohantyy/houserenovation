<?php
#==========Login Routes=====================
Route::get('admin/login','Admin\Auth\LoginController@loginPage');
Route::post('admin/login','Admin\Auth\LoginController@login');
Route::get('admin/logout','Admin\Auth\LoginController@logout');

Route::get('warehouse/login','Warehouse\Auth\LoginController@loginPage');
Route::post('warehouse/login','Warehouse\Auth\LoginController@login');
Route::get('warehouse/logout','Warehouse\Auth\LoginController@logout');
Route::get('warehouse/register','Warehouse\Auth\RegisterController@Register');
Route::post('warehouse/save-register','Warehouse\Auth\RegisterController@saveRegister');

Route::get('housecaptain/login','HouseCaptain\Auth\LoginController@loginPage');
Route::post('housecaptain/login','HouseCaptain\Auth\LoginController@login');
Route::get('housecaptain/logout','HouseCaptain\Auth\LoginController@logout');
Route::get('housecaptain/register','HouseCaptain\Auth\RegisterController@Register');
Route::post('housecaptain/save-register','HouseCaptain\Auth\RegisterController@saveRegister');
#========== Login Routes End ================

#========== User Routes =====================
Route::get('/','User\HomeController@index');
Route::get('house-repair-form','User\HouseRepairFormController@index');
Route::post('house-repair-form-save','User\HouseRepairFormController@save');
Route::get('Successfull','User\HouseRepairFormController@successfull');

Route::get('admin/register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('admin/register-save', 'Admin\Auth\RegisterController@register');

Route::get('/getstate', 'User\HouseRepairFormController@getstate');
Route::post('/getcity', 'User\HouseRepairFormController@getcity');