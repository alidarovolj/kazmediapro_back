<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'App\Http\Controllers\Api\Auth\LoginController@login');
Route::get('refresh', 'App\Http\Controllers\Api\Auth\LoginController@refresh');
Route::post('userRegistration', 'App\Http\Controllers\Api\User\UserController@userRegistration');
Route::post('messageSave', 'App\Http\Controllers\Api\Messages\MessagesController@messageSave');
Route::get('cases', 'App\Http\Controllers\Api\Cases\CasesController@cases');
Route::post('categoryCases', 'App\Http\Controllers\Api\Categories\CategoriesController@categoryCases');
Route::get('categoryById/{id}', 'App\Http\Controllers\Api\Categories\CategoriesController@categoryById');

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::put('updatePassword', 'App\Http\Controllers\Api\User\UserController@updatePassword');
    Route::put('updateUserInfo', 'App\Http\Controllers\Api\User\UserController@updateUserInfo');
    Route::get('user', 'App\Http\Controllers\Api\User\UserController@userData');
    Route::post('createCategory', 'App\Http\Controllers\Api\Categories\CategoriesController@createCategory');
    Route::get('categories', 'App\Http\Controllers\Api\Categories\CategoriesController@categories');
    Route::post('caseSave', 'App\Http\Controllers\Api\Cases\CasesController@caseSave');
    Route::get('allUsers', 'App\Http\Controllers\Api\User\UserController@allUsers');
    Route::get('messagesList', 'App\Http\Controllers\Api\Messages\MessagesController@messagesList');
    Route::get('clients', 'App\Http\Controllers\Api\Clients\ClientsController@clients');
    Route::get('projects', 'App\Http\Controllers\Api\Projects\ProjectsController@projects');
    Route::post('projectSave', 'App\Http\Controllers\Api\Projects\ProjectsController@projectSave');
    Route::post('clientSave', 'App\Http\Controllers\Api\Clients\ClientsController@clientSave');
});
