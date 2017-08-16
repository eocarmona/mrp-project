<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function() {

//****************************************/ Start/*************************

	Route::resource('start','SSys\SStartController');
	Route::get('/start',[
		'as' => 'start',
		'uses' => 'SSys\SStartController@index'
	]);
	Route::post('/start/in',[
		'as' => 'start.getIn',
		'uses' => 'SSys\SStartController@GetIn'
	]);

//****************************************/ Admin/*************************
	Route::group(['middleware' => ['mdadmin']], function() {

		Route::get('/admin',[
			'as' => 'plantilla.admin',
			'uses' => 'SPlantillaController@index'
		]);

		Route::get('/captura',[
			'as' => 'Plantilla.captura',
			'uses' => 'SPlantillaController@captura'
		]);

		Route::get('/listado',[
			'as' => 'Plantilla.listado',
			'uses' => 'SPlantillaController@listado'
		]);

		Route::resource('users','SUsersController');
		Route::get('users/{id}/activate', [
			'uses' => 'SUsersController@Activate',
			'as' => 'users.activate'
		]);
		Route::get('users/{id}/destroy',[
			'uses' => 'SUsersController@Destroy',
			'as' => 'users.destroy'
		]);

		Route::resource('privileges','SSys\SPrivilegesController');
		Route::get('privileges/{id}/activate', [
			'uses' => 'SSys\SPrivilegesController@Activate',
			'as' => 'privileges.activate'
		]);
		Route::get('privileges/{id}/destroy',[
			'uses' => 'SSys\SPrivilegesController@Destroy',
			'as' => 'privileges.destroy'
		]);

		Route::resource('permissions','SSys\SPermissionsController');
		Route::get('permissions/{id}/activate', [
			'uses' => 'SSys\SPermissionsController@Activate',
			'as' => 'permissions.activate'
		]);
		Route::get('permissions/{id}/destroy',[
			'uses' => 'SSys\SPermissionsController@Destroy',
			'as' => 'permissions.destroy'
		]);

		Route::resource('userPermissions','SSys\SUserPermissionsController');
		Route::get('userPermissions/{id}/activate', [
			'uses' => 'SSys\SUserPermissionsController@Activate',
			'as' => 'userPermissions.activate'
		]);
		Route::get('userPermissions/{id}/destroy',[
			'uses' => 'SSys\SUserPermissionsController@Destroy',
			'as' => 'userPermissions.destroy'
		]);

	});

//****************************************/ Company /*************************

	Route::group(['middleware' => ['mdcompany']], function() {

		Route::get('/modules',[
			'as' => 'start.selmod',
			'uses' => 'SSys\SStartController@SelectModule'
		]);

//****************************************/ Manufacturing /*************************
		Route::get('/mms/home',[
			'as' => 'mms.home',
			'uses' => 'SMMS\SProductionController@Home'
		]);
		Route::resource('mms','SMMS\SProductionController');

//****************************************/ Quality /*************************
		Route::get('/qms/home',[
			'as' => 'qms.home',
			'uses' => 'SQMS\SQualityController@Home'
		]);
		Route::resource('qms','SQMS\SQualityController');

//****************************************/ Warehouses /*************************
		Route::get('/wms/home',[
			'as' => 'wms.home',
			'uses' => 'SWMS\SWarehousesController@Home'
		]);
		Route::resource('wms','SWMS\SWarehousesController');


//****************************************/ Shipments /*************************
		Route::get('/tms/home',[
			'as' => 'tms.home',
			'uses' => 'STMS\SShipmentsController@Home'
		]);
		Route::resource('tms','STMS\SShipmentsController');


	});
});

Route::get('auth/login', [
	'uses' => 'Auth\AuthController@getLogin',
	'as'   => 'auth.login'
]);
Route::post('auth/login', [
	'uses' => 'Auth\AuthController@postLogin',
	'as'   => 'auth.login'
]);
Route::get('auth/logout', [
	'uses' => 'Auth\AuthController@getLogout',
	'as'   => 'auth.logout'
]);
