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


Route::get('/', [
    'uses' => 'WelcomeController@index',
    'as' => 'welcome'
]);

*/

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
 ]);


//ROUTES TO REGISTER USER//////////////////////////////////////////////////////////////////////////

Route::get('auth/register', 'Auth\AuthController@getRegister');

Route::get('/user', [
    'as' => 'update_user',
    'uses' => 'UserController@edit'
]);

Route::post('/user/{id}/refresh', 'UserController@update');

Route::get('/logout', [
    'uses' => 'UserController@logout',
    'as' => 'logout'
]);

Route::get('/desktop', [
    'as' => 'login_user',
    'uses' => 'UserController@desktop'
]);

///////////////////////////////////////////////////////////////////////////////////////////////////////////
//---------------------------------------------------------------------------------------------------------
//ROUTES TO USER ADMIN/////////////////////////////////////////////////////////////////////////////////////

Route::get('/admin', [
    'as' => 'login_admin',
    'uses' => 'AdminController@desktop'
]);

Route::get('/admin/verificar_usuarios', [
    'as' => 'verificar_usuarios',
    'uses' => 'AdminController@verificarUsuariosindex'
]);

Route::get('/admin/verificar_roles', [
    'as' => 'verificar_roles',
    'uses' => 'AdminController@GestionRolIndex'
]);

Route::post('/admin/verificar_roles/{id}/new_rol', 'AdminController@storeRoles');

Route::post('/admin/verificar_roles/search', 'AdminController@GestionRolesSearch');

Route::get('/admin/verificar_usuarios/{id}/aceptar', 'AdminController@aceptarUsuario');

Route::get('/admin/verificar_usuarios/{id}/descartar', 'AdminController@descartarUsuario');

////////////////////////////////////////////////////////////////////////////////////////////////////
//--------------------------------------------------------------------------------------------------
//ROUTES TO CRUD MUNICIPIO//////////////////////////////////////////////////////////////////////////

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

////////////////////////////////////////////////////////////////////////////////////////
//--------------------------------------------------------------------------------------
//////////////////ROUTES TO CRUD DEPARTAMENTO /////////////////////////////////////////

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

/////////////////////////////////////////////////////////////////////////////////////////
//---------------------------------------------------------------------------------------
//////////////////ROUTES TO CRUD CARGO_USUARIO //////////////////////////////////////////

Route::get('/admin/cargo_usuario', [
    'as' => 'cargoUsuario',
    'uses' => 'CargoUsuarioController@index'
]);

Route::get('admin/cargo_usuario/{id}/editar', 'CargoUsuarioController@edit');

Route::post('admin/cargo_usuario/{id}/refresh', 'CargoUsuarioController@update');

Route::get('admin/cargo_usuario/nuevo', [
    'as' => 'nuevo_cargo',
    'uses' => 'CargoUsuarioController@create'
]);

Route::post('admin/cargo_usuario/new_cargo', 'CargoUsuarioController@store');

Route::get('admin/cargo_usuario/{id}/eliminar', [
    'uses' => 'CargoUsuarioController@destroy',
    'as' => 'eliminar_cargo'
]);

///////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------------------------------------------------------------
//////////////////ROUTES TO CRUD TIPO DE IDENTIFICACION //////////////////////////////////////////

Route::get('/admin/tipo_identificacion', [
    'as' => 'tipoIdentificacion',
    'uses' => 'TipoIdentificacionController@index'
]);

Route::get('admin/tipo_identificacion/{id}/editar', 'TipoIdentificacionController@edit');

Route::post('admin/tipo_identificacion/{id}/refresh', 'TipoIdentificacionController@update');

Route::get('admin/tipo_identificacion/nuevo', [
    'as' => 'new_identificacion',
    'uses' => 'TipoIdentificacionController@create'
]);

Route::post('admin/tipo_identificacion/new_identificacion', 'TipoIdentificacionController@store');

Route::get('admin/tipo_identificacion/{id}/eliminar', [
    'uses' => 'TipoIdentificacionController@destroy',
    'as' => 'eliminar_identificacion'
]);

/////////////////////////////////////////////////////////////////////////////////////////////////////
//--------------------------------------------------------------------------------------------------
//////////////////ROUTES TO CRUD TIPO DE SECRETARIA//////////////////////////////////////////////////

Route::get('/admin/tipo_secretaria', [
    'as' => 'tipoSecretaria',
    'uses' => 'TipoSecretariaController@index'
]);

Route::get('admin/tipo_secretaria/{id}/editar', 'TipoSecretariaController@edit');

Route::post('admin/tipo_secretaria/{id}/refresh', 'TipoSecretariaController@update');

Route::get('admin/tipo_secretaria/nuevo', [
    'as' => 'new_secretaria',
    'uses' => 'TipoSecretariaController@create'
]);

Route::post('admin/tipo_secretaria/new_secretaria', 'TipoSecretariaController@store');

Route::get('admin/tipo_secretaria/{id}/eliminar', [
    'uses' => 'TipoSecretariaController@destroy',
    'as' => 'eliminar_sec'
]);

/////////////////////////////////////////////////////////////////////////////////////////////////////
//---------------------------------------------------------------------------------------------------
//////////////////ROUTES TO CRUD NOTICIA/////////////////////////////////////////////////////////////

Route::get('/admin/noticia', [
    'as' => 'noticia',
    'uses' => 'NoticiaController@index'
]);

Route::get('admin/noticia/{id}/editar', 'NoticiaController@edit');

Route::post('admin/noticia/{id}/refresh', 'NoticiaController@update');

Route::get('admin/noticia/nuevo', [
    'as' => 'new_noticia',
    'uses' => 'NoticiaController@create'
]);

Route::post('admin/noticia/new_noticia', 'NoticiaController@store');

Route::get('admin/noticia/{id}/eliminar', [
    'uses' => 'NoticiaController@destroy',
    'as' => 'eliminar_noti'
]);

/////////////////////////////////////////////////////////////////////////////////////////////////////
//---------------------------------------------------------------------------------------------------
//////////////////ROUTES TO CRUD BIBLIOTECA/////////////////////////////////////////////////////////////

Route::get('/admin/biblioteca', [
    'as' => 'biblioteca',
    'uses' => 'BibliotecaController@index'
]);

Route::get('admin/biblioteca/{id}/editar', 'BibliotecaController@edit');

Route::post('admin/biblioteca/{id}/refresh', 'BibliotecaController@update');

Route::get('admin/biblioteca/nuevo', [
    'as' => 'new_biblioteca',
    'uses' => 'BibliotecaController@create'
]);

Route::post('admin/biblioteca/new_biblioteca', 'BibliotecaController@store');

Route::get('admin/biblioteca/{id}/eliminar', [
    'uses' => 'BibliotecaController@destroy',
    'as' => 'eliminar_bib'
]);

/////////////////////////////////////////////////////////////////////////////////////////////////////
//---------------------------------------------------------------------------------------------------
//////////////////ROUTES TO CREATE PLAN DE DESARROLLO/////////////////////////////////////////////////////////////

Route::get('/admin/plan_desarrollo', [
    'as' => 'plan_desarrollo',
    'uses' => 'planDesarrolloController@indexMainPlanDesarrollo'
]);

Route::get('admin/plan_desarrollo/{id}/eliminar', [
    'as' => 'eliminar_plan',
    'uses' => 'planDesarrolloController@PrincipalEliminarPlanDesarrollo'

]);

Route::get('admin/plan_desarrollo/nuevo_plan', [
    'as' => 'new_plan_municipal',
    'uses' => 'planDesarrolloController@nuevoPlanMunicipal',
    'middleware' => 'existe_plan'
]);

Route::post('admin/plan_desarrollo/new_plan',[
    'as' => 'store_plan',
    'uses' => 'planDesarrolloController@storePlanDesarrolloMunicipal',
    'middleware' => 'existe_plan'
]);

Route::get('admin/plan_desarrollo/{id}/editar', 'planDesarrolloController@edit');

Route::post('admin/plan_desarrollo/{id}/refresh', 'planDesarrolloController@update');

//-----eje-------------

Route::get('admin/plan_desarrollo/nuevo_eje_estrategico', [
    'as' => 'new_eje_estrategico',
    'uses' => 'ejeEstrategicoController@create'
]);

Route::post('admin/plan_desarrollo/new_eje_estrategico', 'ejeEstrategicoController@store');

Route::get('admin/plan_desarrollo/next_eje', [
    'as' => 'next_eje',
    'uses' => 'ejeEstrategicoController@nextEje'
]);

Route::get('admin/plan_desarrollo/eje/{id}/editar', 'ejeEstrategicoController@edit');

Route::post('admin/plan_desarrollo/eje/{id}/refresh', 'ejeEstrategicoController@update');

Route::get('admin/plan_desarrollo/eje/{id}/eliminar', 'ejeEstrategicoController@destroy');
//----------Programa-------------------

Route::get('admin/plan_desarrollo/nuevo_programa', [
    'as' => 'new_programa',
    'uses' => 'ProgramaController@create'
]);

Route::post('admin/plan_desarrollo/new_programa', 'ProgramaController@store');

Route::get('admin/plan_desarrollo/next_program', [
    'as' => 'next_programa',
    'uses' => 'ProgramaController@nextPrograma'
]);

Route::get('admin/plan_desarrollo/programa/{id}/editar', 'ProgramaController@edit');

Route::post('admin/plan_desarrollo/programa/{id}/refresh', 'ProgramaController@update');

Route::get('admin/plan_desarrollo/programa/{id}/eliminar', 'ProgramaController@destroy');

//----------SubPrograma-------------------

Route::get('admin/plan_desarrollo/nuevo_subPrograma', [
    'as' => 'new_subPrograma',
    'uses' => 'SubProgramaController@create'
]);

Route::post('admin/plan_desarrollo/new_subPrograma', 'SubProgramaController@store');

Route::get('admin/plan_desarrollo/next_subProgram', [
    'as' => 'next_subPrograma',
    'uses' => 'SubProgramaController@nextPrograma'
]);

Route::get('admin/plan_desarrollo/subPrograma/{id}/editar', 'SubProgramaController@edit');

Route::post('admin/plan_desarrollo/subPrograma/{id}/refresh', 'SubProgramaController@update');

Route::get('admin/plan_desarrollo/subPrograma/{id}/eliminar', 'SubProgramaController@destroy');

//--------------META-----------------------

Route::get('admin/plan_desarrollo/nueva_meta', [
    'as' => 'new_meta',
    'uses' => 'MetaController@create'
]);

Route::post('admin/plan_desarrollo/new_meta', 'MetaController@store');

Route::get('admin/plan_desarrollo/finish_meta', [
    'as' => 'finish_meta',
    'uses' => 'MetaController@finish_meta'
]);

Route::get('admin/plan_desarrollo/meta/programa/{id}/editar', 'MetaController@edit_meta_programa');

Route::post('admin/plan_desarrollo/meta/programa/{id}/refresh', 'MetaController@update_meta_programa');


Route::get('admin/plan_desarrollo/meta/subPrograma/{id}/editar', 'MetaController@edit_meta_subPrograma');

Route::post('admin/plan_desarrollo/meta/subPrograma/{id}/refresh', 'MetaController@update_meta_subPrograma');

Route::get('admin/plan_desarrollo/meta/{id}/eliminar', 'MetaController@destroy');











