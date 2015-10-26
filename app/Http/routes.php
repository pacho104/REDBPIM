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


//ROUTES TO REGISTER USER///////////////////////////////////////////
Route::get('auth/register', 'Auth\AuthController@getRegister');

Route::get('/admin', [
    'as' => 'login_admin',
    'uses' => 'AdminController@desktop'
]);
Route::get('/logout', [
    'as' => 'logout',
    'uses' => 'AdminController@logout'
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
/////////////////ROUTES TO CRUD DEPARTAMENTO ////////////////////////////
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
//////////////////////////////////////////////////////////////////////////
//-----------------------------------------------------------------------------
//////////////7///ROUTES TO CRUD CARGO_USUARIO ////////////////////////////
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
///////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------------------------------------------------------------
//////////////////ROUTES TO CRUD TIPO DE SECRETARIA////////////////////////////////////////////////
Route::get('/admin/tipo_secretaria', [
    'as' => 'tipoSecretaria',
    'uses' => 'TipoSecretariaController@index'
]);

Route::get('admin/tipo_secretaria/{id}/editar', 'TipoSecretariaController@edit');

Route::post('admin/tipo_secretaria/{id}/refresh', 'TipoSecretariaController@update');

Route::get('admin/tipo_secretaria/nuevo', [
    'as'   => 'new_secretaria',
    'uses' => 'TipoSecretariaController@create'
]);

Route::post('admin/tipo_secretaria/new_secretaria', 'TipoSecretariaController@store');

Route::get('admin/tipo_secretaria/{id}/eliminar', [
    'uses' => 'TipoSecretariaController@destroy',
    'as'   => 'eliminar_sec'
]);
///////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------------------------------------------------------------
//////////////////ROUTES TO CRUD NOTICIA//////////////////////////////////////////////////////////
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


Route::group(['middleware' => ['auth']], /**
 *
 */
    function () {

   // Route::resource('roles', 'RolesController');

   // Route::get('/permisos','PermissionController@index');
   // Route::get('/permisos/asignar','PermissionController@asignar');
   // Route::get('/permisos/desasignar','PermissionController@desasignar');

    Route::get('msj/{id}','UsuarioSalaController@mjsUsuarioSala');

    Route::get('requisitos/{id}',
        [
            'as' => 'req',
            'uses' => 'ListaChequeoController@requisitoLista'
        ]);

    Route::get('requisitosMun/{id}',
        [
            'as' => 'reqMun',
            'uses' => 'ListaChequeoController@requisitoListaMun'
        ]);



    Route::get('sala/{id}','UsuarioSalaController@registrarUsuarioSala');

    Route::get('crearMesa/{id}','MensajeController@crearMensaje');

    Route::get('nue','ListaChequeoController@registrarReq');

    Route::get('elReq/{id}','ListaChequeoController@eliminarReq');

    Route::get('reqMun', [
        'as' => 'reqM',
        'uses' => 'RequisitoController@indexReqMun'
    ]);

    Route::get('creaMun','RequisitoController@createReqMun');

    Route::post('newMun','RequisitoController@storeReqMun');

    Route::get('editMunReq/{id}','RequisitoController@editReqMun');


    Route::get('lisMun', [
        'as' => 'lisM',
        'uses' => 'ListaChequeoController@indexLiMun'
    ]);

    Route::get('creaLiMun','ListaChequeoController@createLiMun');

    Route::post('newLiMun','ListaChequeoController@storeLiMun');

    Route::get('editLiMun/{id}','ListaChequeoController@editLiMun');



    Route::get('salasDis','SalasChatController@salasOn');

    Route::resource('salas','SalasChatController');
    Route::resource('mensaje','MensajeController');
    Route::resource('usuarioSala','UsuarioSalaController');
    Route::resource('chats','ChatController');
    Route::resource('estados','EstadoController');
    Route::resource('requisito','RequisitoController');
    Route::resource('lista','ListaChequeoController');
    Route::resource('proceso','ProcesoController');
    Route::resource('recurso','RecursoController');
    Route::resource('etapaLista','EtapaListaController');
    Route::resource('sectorInversion','SectorInversionController');

    Route::post('esta/{id}','SalasChatController@cambiarEstado');


});






