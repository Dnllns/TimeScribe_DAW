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
    return view('welcome');
});

//LOGIN - REGISTER
Auth::routes();

//HOME
Route::get('/home', 'HomeController@index')->name('home');

//-------PROYECTO--------------------------------------------------------

//DASHBOARD
#region BOTONES PROJECT ITEM (PLANTILLA) en DASHBOARD

//VISTA VISUALIZAR PROYECTO
Route::get('/project-dashboard/{projectId}', 'ProjectController@view_dashboard')->name('project-dashboard');
//VISTA EDITAR PROYECTO
Route::get('/project-edit/{projectId}', 'ProjectController@view_editProject')->name('project-edit');
// BD MODIFICAR DATOS DE UN PROYECTO
Route::get('/project-delete/{projectId}', 'ProjectController@deleteProject')->name('project-delete')->middleware('auth');

#end region

//VISTA NUEVO PROYECTO
Route::get('/project-new', 'ProjectController@view_newProject')
    ->name('rt_pr_new')
    ->middleware('auth');

//VISTA SELECCIONAR PROYECTO
Route::get('/project-select', 'ProjectController@view_selectProject')
    ->name('rt_pr_select');

//BD INSERTAR NUEVO PROYECTO
Route::post('/project-register', 'ProjectController@create')
    ->name('rt_pr_register')
    ->middleware('auth');

// BD MODIFICAR DATOS DE UN PROYECTO
Route::post('/project-update/{projectId}', 'ProjectController@updateProject')
    ->name('rt_pr_update')
    ->middleware('auth');

//-------TASKGROUP--------------------------------------------------------

//VISTA CEAR NUEVO TASKGROUP
Route::get('/taskgroup-new/{projectId}', 'TaskGroupController@view_newTaskGroup')
    ->name('rt_tg_new');

//VISTA EDITAR TASKGROUP
Route::get('/taskgroup-edit/{taskGroupId}', 'TaskGroupController@view_editTaskGroup')
    ->name('rt_tg_edit')
    ->middleware('auth');

// BD INSERTAR DATOS DE UN TASKGROUP
Route::post('/taskgroup-register/{projectId}', 'TaskGroupController@create')
    ->name('rt_tg_register')
    ->middleware('auth');

// BD MODIFICAR DATOS DE UN TASKGROUP
Route::post('/taskgroup-update/{taskGroupId}', 'TaskGroupController@updateTaskGroup')
    ->name('rt_tg_update')
    ->middleware('auth');

// BD MODIFICAR DATOS DE UN TASKGOUP
Route::get('/taskgroup-delete/{taskGroupId}', 'TaskGroupController@deleteTaskGroup')
    ->name('rt_tg_delete')
    ->middleware('auth');

//------------------------------TASK------------------

//VISTA Crear TASK
Route::get('/task-new/{taskGroupId}', 'TaskController@view_newTask')
    ->name('rt_ts_new');

//VISTA EDITAR TAREA
Route::get('/task-edit/{taskId}', 'TaskController@view_editTask')
    ->name('rt_ts_edit');

// BD INSERTAR DATOS DE UN TASK
Route::post('/task-register/{taskGroupId}', 'TaskController@create')
    ->name('rt_ts_register')
    ->middleware('auth');

// BD MODIFICAR DATOS DE UN TASK
Route::post('/task-update/{taskId}', 'TaskController@updateTask')
    ->name('rt_ts_update')
    ->middleware('auth');

// BD eliminar TASK
Route::get('/task-delete/{taskId}', 'TaskController@deleteTask')
    ->name('rt_ts_delete')
    ->middleware('auth');

#region TASK CARD BUTTONS, AJAX

// MARCAR INICIADO
Route::get('/task-set-started/{taskId}', 'TaskController@setStarted')->name('taskCard-setStarted')->middleware('auth');
// MARCAR TERMINADO
Route::get('/task-set-done/{taskId}', 'TaskController@setDone')->name('taskCard-setDone')->middleware('auth');
// MARCAR ELIMINADO
Route::get('/task-set-delete/{taskId}', 'TaskController@setDelete')->name('taskCard-setDelete')->middleware('auth');

Route::get('/ct-getworkedtime/{taskId}', 'TaskController@getWorkedTime')
    ->name('ct_gwt')->middleware('auth');

/**
 * Iniciar una tarea por hacer
 */
// Route::get('/ct-startnew/{taskId}', 'TaskController@startNewTask') ->name('ct_startnew')->middleware('auth');

#endregion

#region STICKY CHRONO

//
Route::get('/chrono-start/{taskId}', 'TaskController@startCount')->name('chrono-start')->middleware('auth');
//
Route::get('/chrono-stop', 'TaskController@stopCount')->name('chrono-stop')->middleware('auth');
//Eliminar timerecords borrador
Route::get('/chrono-reset/{taskId}', 'TimeRecordController@removeLastTimerecordsInteraction')->name('chrono-reset')->middleware('auth');
//Actualizar timerecords borrador a finalizados
Route::get('/chrono-finish/{taskId}', 'TimeRecordController@setFinalTimerecordsInteraction')->name('chrono-finish')->middleware('auth');

#endregion

//---------------------- CLIENTE -------------------------------------

Route::get('/client-dashboard', 'UserController@view_clientDashboard')
    ->name('client_dashboard')->middleware('auth');
