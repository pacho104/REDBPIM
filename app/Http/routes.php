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

Route::get('/', [
    'uses' => 'WelcomeController@index',
    'as' => 'welcome'
]);

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
 ]);


//ROUTES TO REGISTER USER///////////////////////////////////////////
Route::get('auth/register', 'Auth\AuthController@getRegister');

Route::get('/desktop', 'AdminController@desktop');

Route::get('/desktop',[
    'as' => 'login',
    'uses' => 'AdminController@desktop'
]);
Route::get('/logout', [
    'uses' => 'AdminController@logout',
    'as' => 'logout'
]);
//////////////////////////////////////////////////////////////////////


//ROUTES TO CRUD MUNICIPIO////////////////////////////////////////////
Route::get('/admin/municipio',[
    'as' => 'municipio',
    'uses' => 'MunicipioController@index'
]);

Route::get('admin/municipio/{id}/editar','MunicipioController@edit');

Route::post('admin/municipio/{id}/refresh','MunicipioController@update');

Route::get('admin/municipio/nuevo', [
    'as' => 'nuevo_mun',
    'uses' => 'MunicipioController@create'
]);

Route::post('admin/municipio/new_mun', 'MunicipioController@store');

Route::get('admin/municipio/{id}/eliminar', [
    'uses' => 'MunicipioController@destroy',
    'as' => 'eliminar_mun'
]);
//////////////////////////////////////////////////////////////////////////
//-----------------------------------------------------------------------------
//////////////7///ROUTES TO CRUD DEPARTAMENTO ////////////////////////////
Route::get('/admin/departamento',[
    'as' => 'departamento',
    'uses' => 'DepartamentoController@index'
]);

Route::get('admin/departamento/{id}/editar','DepartamentoController@edit');

Route::post('admin/departamento/{id}/refresh','DepartamentoController@update');

Route::get('admin/departamento/nuevo', [
    'as' => 'nuevo_dep',
    'uses' => 'DepartamentoController@create'
]);

Route::post('admin/departamento/new_dep', 'DepartamentoController@store');

Route::get('admin/departamento/{id}/eliminar', [
    'uses' => 'DepartamentoController@destroy',
    'as' => 'eliminar_dep'
]);
////////////////////////////////////////////////////////////////////////////






