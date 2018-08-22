<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('create-todo', 'TodoController@newTodo');
Route::post('show-all-todos', 'TodoController@showAllTodos');
Route::post('show-pending-todos', 'TodoController@showPendingTodos');
Route::post('show-todo', 'TodoController@showTodo');
Route::post('show-trashed-todos', 'TodoController@showTrashedTodos');
Route::post('search-title-todos', 'TodoController@searchTitleTodos');
Route::post('update-todo', 'TodoController@updateTodo');
Route::post('delete-todos', 'TodoController@deleteTodos');
Route::post('force-delete-todos', 'TodoController@forceDeleteTodos');
Route::post('restore-todos', 'TodoController@restoreTodos');
// Route::get('todo', 'TodoController@index');
// Route::get('todo/{id}', 'TodoController@show');

Route::get('priority', 'PriorityController@showPriorities');
Route::post('priority-by-id', 'PriorityController@showPriority');
Route::post('create-priority', 'PriorityController@newPriority');
Route::post('update-priority', 'PriorityController@updatePriority');
//Route::post('priority', 'PriorityController@store');
//Route::delete('priority/{id}', 'PriorityController@delete');

Route::get('category', 'CategoryController@showCategories');
Route::post('category-by-id', 'CategoryController@showCategory');
Route::post('create-category', 'CategoryController@newCategory');
Route::post('update-category', 'CategoryController@updateCategory');
//Route::delete('category/{category}', 'CategoryController@delete');

Route::post('login', 'UserController@login');
Route::post('create-user', 'UserController@newUser');
Route::post('show-all-users', 'UserController@showUsers');
Route::post('show-user', 'UserController@showUser');
Route::post('update-user', 'UserController@updateUser');
Route::post('update-user-settings', 'UserController@updateSettingsUser');
Route::post('delete-users', 'UserController@deleteUsers');
