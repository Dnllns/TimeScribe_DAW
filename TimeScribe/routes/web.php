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

//----------------------------VISTAS----------------------------

Route::get('/', function () {
    return view('welcome');
});

//LOGIN - REGISTER
Auth::routes();

//HOME
Route::get('/home', 'HomeController@index')->name('home');

//CREAR NUEVO PROYECTO
Route::get(
    '/project-new',
    'ProjectController@view_newProject'
)
    ->name('rt_pr_new')
    ->middleware('auth');

//SELECCIONAR PROYECTO
Route::get(
    '/project-select',
    'ProjectController@view_selectProject'
)->name('rt_pr_select');

//EDITAR PROYECTO
Route::get(
    '/project-edit/{projectId}',
    'ProjectController@view_editProject'
)->name('rt_pr_edit');

//EDITAR TASKGROUP
Route::get(
    '/taskgroup-edit/{taskGroupId}',
    'TaskGroupController@view_editTaskGroup'
)->name('rt_tg_edit');

//---------------------------BD---------------------------------------

//BD INSERTAR NUEVO PROYECTO
Route::post(
    '/project-register',
    'ProjectController@create'
)
    ->name('rt_pr_register')
    ->middleware('auth');

// BD MODIFICAR DATOS DE UN PROYECTO
Route::post(
    '/project-update/{projectId}',
    'ProjectController@updateProject'
)
    ->name('rt_pr_update')
    ->middleware('auth');

// BD INSERTAR DATOS DE UN TASKGROUP
Route::post(
    '/taskgroup-new/{projectId}',
    'TaskGroupController@create'
)
    ->name('rt_tg_create')
    ->middleware('auth');
