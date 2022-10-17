<?php


Route::get('/','HomeController@index');

#=== House Repair Request ===

// Route::group(['middleware'=>'can:haveAdminAccess'],function(){

#=== Field Assistant ===
Route::group(['middleware' => ['check_role:admin']], function () {

Route::get('field-assistants','FieldAssistantController@index');
Route::get('field-assistant-create','FieldAssistantController@create');
Route::post('field-assistant-save','FieldAssistantController@save');
Route::get('field-assistant-edit/{id}','FieldAssistantController@edit');
Route::post('field-assistant-update','FieldAssistantController@update');

});

#=== States ====
Route::get('states','StateCityController@statePage')->middleware(['check_role_or_permissions:admin|state_own|state_global']);

Route::group(['middleware' => ['check_role_or_permissions:admin|state_create']], function () {
    Route::get('state-create','StateCityController@createStatePage');
    Route::post('state-save','StateCityController@saveState');
});

Route::group(['middleware' => ['check_role_or_permissions:admin|state_update']], function () {
    Route::get('state-edit/{id}','StateCityController@editStatePage');
    Route::post('state-update','StateCityController@updateState');
});
#=== Cities ====
Route::get('cities','StateCityController@cityPage')->middleware(['check_role_or_permissions:admin|city_own|city_global']);

Route::group(['middleware' => ['check_role_or_permissions:admin|city_create']], function () {
    Route::get('city-create','StateCityController@createCityPage');
    Route::post('city-save','StateCityController@saveCity');
});

Route::group(['middleware' => ['check_role_or_permissions:admin|city_update']], function () {
    Route::get('city-edit/{id}','StateCityController@editCityPage');
    Route::post('city-update/{id}','StateCityController@updateCity');
});
#===return product ===#
Route::group(['middleware' => ['check_role:admin']], function () {
    Route::get('return','HouseRepairRequestController@return');
});
Route::get('/return_requiredinventory/{id}','HouseRepairRequestController@returninventory');
#=== Warehouse manager ===

Route::get('warehouse-managers','WarehouseManagerController@index')->middleware(['check_role_or_permissions:admin|warehouse-manager_own|warehouse-manager_global']);

Route::group(['middleware' => ['check_role_or_permissions:admin|warehouse-manager_create']], function () {
    Route::get('warehouse-manager-create','WarehouseManagerController@create');
    Route::post('warehouse-manager-save','WarehouseManagerController@save');
});

Route::group(['middleware' => ['check_role_or_permissions:admin|warehouse-manager_update']], function () {
    Route::get('warehouse-manager-edit/{id}','WarehouseManagerController@edit');
    Route::post('warehouse-manager-update','WarehouseManagerController@update');
});

Route::get('/warehousenotapproved/{id}', 'WarehouseManagerController@notapproved');
Route::get('/warehouseapproved/{id}', 'WarehouseManagerController@approved');


#=== Warehouse ===
Route::get('warehouses','WarehouseController@index')->middleware(['check_role_or_permissions:admin|warehouse_own|warehouse_global']);

Route::group(['middleware' => ['check_role_or_permissions:admin|warehouse_create']], function () {
    Route::get('warehouse-create','WarehouseController@create');
    Route::post('warehouse-save','WarehouseController@save');
});

Route::group(['middleware' => ['check_role_or_permissions:admin|warehouse_update']], function () {
    Route::get('warehouse-edit/{id}','WarehouseController@edit');
    Route::post('warehouse-update','WarehouseController@update');
});

#=== Inventories ===

Route::get('inventories','InventoriesController@index')->middleware(['check_role_or_permissions:admin|inventory_own|inventory_global']);

Route::group(['middleware' => ['check_role_or_permissions:admin|inventory_create']], function () {
    Route::get('inventory-create','InventoriesController@create');
    Route::post('inventory-save','InventoriesController@save');
});

Route::group(['middleware' => ['check_role_or_permissions:admin|inventory_update']], function () {
    Route::get('inventory-edit/{id}','InventoriesController@edit');
    Route::post('inventory-update','InventoriesController@update');
});

// Route::get('importview', 'InventoriesController@importView');
Route::post('/import', 'InventoriesController@import')->name('import');
Route::get('/export', 'InventoriesController@export')->name('export');

#=== House Captains ===
Route::get('house-captains','HousecaptainController@index')->middleware(['check_role_or_permissions:admin|house-captain_own|house-captain_global']);

Route::group(['middleware' => ['check_role_or_permissions:admin|house-captain_create']], function () {
    Route::get('house-captain-create','HousecaptainController@create');
    Route::post('house-captain-save','HousecaptainController@save'); 
});

Route::group(['middleware' => ['check_role_or_permissions:admin|house-captain_update']], function () {
    Route::get('house-captain-edit/{id}','HousecaptainController@edit');
    Route::post('house-captain-update','HousecaptainController@update');
});

Route::get('/adminnotapproved/{id}', 'HousecaptainController@notapproved');
Route::get('/adminapproved/{id}', 'HousecaptainController@approved');

#=== House Repair Requests ===
Route::group(['middleware' => ['check_role:admin']], function () {
    Route::get('house-repair-requests','HouseRepairRequestController@index');
    Route::get('house-repair-request-view/{id}','HouseRepairRequestController@view');
    Route::get('/house-repair-request-accepted/{id}','HouseRepairRequestController@acceptUserbyadmin');
    Route::get('/house-repair-request-rejected/{id}','HouseRepairRequestController@rejectUserbyadmin');
    Route::get('/house-repair-request-edit/{id}','HouseRepairRequestController@edituser');
    Route::post('/house-repair-request-update/{id}','HouseRepairRequestController@updateUser');

});

Route::post('save-custom-data-house-repair-request','HouseRepairRequestController@saveCustomData');
Route::post('assign-field-assistant','HouseRepairRequestController@assignFieldAssistant');
Route::post('house-repair-request-verify','HouseRepairRequestController@verify');
Route::post('accept-interested-house-captain','HouseRepairRequestController@acceptInterestedHouseCaptain');
Route::post('reject-interested-house-captain','HouseRepairRequestController@rejectInterestedHouseCaptain');

Route::post('/save-Warehouse/{id}','HouseRepairRequestController@addWarehouse');



// });
#==================================
# FIELD ASSISTANT ROUTES
Route::group(['prefix'=>'field-assistant'],function(){
    Route::get('verification-requests','FieldAssistant\HouseRepairRequestVerification@index');
    Route::get('verification-request/{id}','FieldAssistant\HouseRepairRequestVerification@view');
    Route::post('upload-verification-document','FieldAssistant\HouseRepairRequestVerification@uploadDocument');
    Route::get('/house-repair-request-accept/{id}','HouseRepairRequestController@acceptUser');
    Route::get('/house-repair-request-reject/{id}','HouseRepairRequestController@rejectUser');
});

#=== Organization ===
Route::get('organization','HomeController@organizationIndex')->middleware(['check_role_or_permissions:admin|organization_own|organization_global']);

Route::group(['middleware' => ['check_role_or_permissions:admin|organization_create']], function () {
    Route::get('organization-create','HomeController@organizationCreate');
    Route::post('organization-save','HomeController@organizationSave');
});

Route::group(['middleware' => ['check_role_or_permissions:admin|organization_update']], function () {
    Route::get('organization-edit/{id}','HomeController@organizationEdit');
    Route::post('organization-update/{id}','HomeController@organizationUpdate');
});

Route::group(['middleware' => ['check_role:admin']], function () {

Route::get('/roles','RoleController@roleIndex');
Route::post('/roles/add','RoleController@roleStore');
Route::get('/roles/{role_id}/delete','RoleController@roleDelete');

Route::get('/permissions-groups','PermissionController@permissionGroupIndex');
Route::get('/permissions-groups/add','PermissionController@permissionGroupCreate');
Route::post('/permissions-groups','PermissionController@permissionGroupStore');
Route::get('/permissions-groups/{permissiongroup_id}/edit','PermissionController@permissionGroupEdit');
Route::put('/permissions-groups/{permissiongroup_id}/edit','PermissionController@permissionGroupUpdate');
Route::get('/permissions-groups/{permissiongroup_id}/delete','PermissionController@deletePermission');

});

Route::get('/role/{role_id}/assign-permission','PermissionController@assignPermission');
Route::post('/role/{role_id}/assign-permission','PermissionController@assignPermissionStore');

Route::get('/export-barcode', 'HouseRepairRequestController@exportBarcode')->name('export');
Route::get('generate-pdf','HouseRepairRequestController@generatePDF');
