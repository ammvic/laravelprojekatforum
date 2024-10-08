<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/threads', function () {
    return view('threads.index');
});
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/verify-code', [App\Http\Controllers\Auth\RegisterController::class, 'verifyCode'])->name('verify.code');


Route::get('/threads/index', 'ThreadController@index')->name('threads.index');
Route::redirect('/threads', '/threads/index');

Route::get('/threads/index', 'ThreadController@index')->name('threads.index');
Route::get('/threads/create', 'ThreadController@create')->name('threads.create');
Route::post('/threads', 'ThreadController@store')->name('threads.store');
Route::post('/threads/{thread}/follow', [\App\Http\Controllers\ThreadController::class, 'follow'])->name('threads.follow');
Route::get('/my-threads', [\App\Http\Controllers\ThreadController::class, 'myThreads'])->name('my-threads');
Route::get('/threads/{thread}/edit', 'App\Http\Controllers\ThreadController@edit')->name('threads.edit'); // Forma za izmenu određene teme
Route::get('/manager', 'App\Http\Controllers\Manager\ThreadController@index')->name('threads.index');
Route::get('/threads/{thread}', 'ThreadController@show')->name('threads.show');

Route::group(['middleware'], function(){
    Route::resource('threads', 'ThreadController')->except(['create', 'store', 'edit', 'update']); 
});


Route::post('/replies/store', 'ReplyController@store')->name('replies.store');
Route::delete('/replies/{reply}', 'ReplyController@destroy')->name('replies.destroy');
Route::post('/replies/{id}/like', [\App\Http\Controllers\ReplyController::class, 'like'])->name('replies.like');
Route::post('/replies/{id}/dislike', [\App\Http\Controllers\ReplyController::class, 'dislike'])->name('replies.dislike');




Auth::routes();
Route::delete('/threads/{thread}', [\App\Http\Controllers\ThreadController::class, 'destroy'])->name('threads.destroy1');

Route::group(['middleware' => ['auth','access.control.list'], 'namespace' => 'Manager', 'prefix' => 'manager'], function(){
    Route::delete('/manager/threads/{id}', [\App\Http\Controllers\Manager\ThreadController::class, 'destroy'])->name('manager.threads.destroy');
});

Route::group(['middleware' => ['auth','access.control.list'], 'namespace' => 'Manager', 'prefix' => 'manager'], function(){
    Route::get('/', function(){
        return redirect()->route('users.index');
    });

    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/threadss', 'ThreadController@index')->name('threadss.index');
    Route::delete('/manager/threads/{id}', [\App\Http\Controllers\Manager\ThreadController::class, 'destroy'])->name('threads.destroy');
    Route::get('/roles', 'RoleController@index')->name('roles.index');
   


    Route::resource('roles', 'RoleController');
    Route::get('roles/{role}/resources', 'RoleController@syncResources')->name('roles.resources');
    Route::put('roles/{role}/resources', 'RoleController@updateSyncResources')->name('roles.resources.update');

    Route::resource('users', 'UserController');
    Route::resource('resources', 'ResourceController');
});



