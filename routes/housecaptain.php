<?php

Route::get('/','HomeController@index');

Route::get('/repair-requests','RepairRequestController@index');
Route::get('/repair-request/{id}','RepairRequestController@view');
Route::get('/repair-request-data/{id}','RepairRequestController@viewData');
Route::get('/view_accept-data','RepairRequestController@viewacceptdata');

Route::post('/show-interest/{id}','BiddingController@showInterest');
Route::get('/completed/{id}','BiddingController@completed');
Route::get('/inspection/{id}','BiddingController@inspection');
Route::get('/reject/{id}','BiddingController@reject');
Route::post('/show-reject/{id}','BiddingController@saveReject');

Route::get('/accept/{id}','BiddingController@accept');
Route::get('/acceptnext/{id}','BiddingController@acceptnext');

Route::post('/save-next/{id}','BiddingController@saveNext');


Route::get('/add-order/{id}','WorkController@orderIndex');

Route::post('/save-order/{id}','WorkController@addRequiredInventoryForWork');

//Register page

// notification
Route::get('/notification','WorkController@notification');









