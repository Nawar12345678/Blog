<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pagescontroller;
use App\Http\Controllers\CommentsControlle;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [pagescontroller::class, 'posts']);


Route::get('/posts/{post}', [pagescontroller::class, 'post']);

//Route::post('/posts/store', [pagescontroller::class, 'store']);

Route::post('/posts/{post}/store', [App\Http\Controllers\CommentsController::class, 'store']);

Route::get('/category/{name}', [App\Http\Controllers\pagescontroller::class, 'category']);

//Auth Route
//Register
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'create']);
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store']);

//Login
Route::get('/login', [App\Http\Controllers\SessionController::class, 'create']);
Route::post('/login', [App\Http\Controllers\SessionController::class, 'store']);

//Logout
Route::get('/logout', [App\Http\Controllers\SessionController::class, 'destroy']);


Route::get('/access_denied', [App\Http\Controllers\pagesController::class, 'accessDenied']);

//statisics
Route::get('/Statistics', [App\Http\Controllers\pagesController::class, 'Statistics']);





//Route as group
Route::group(['middleware' => 'roles', 'roles'=>['Admin']], function() {
    Route::get('/admin', [App\Http\Controllers\pagesController::class, 'admin']);
    Route::post('/add-role', [App\Http\Controllers\pagesController::class, 'addRole']);


});


Route::group(['middleware' => 'roles', 'roles'=>['Editor', 'Admin']], function() {
    Route::get('/editor', [App\Http\Controllers\pagesController::class, 'editor']);
    Route::post('/posts/store', [pagescontroller::class, 'store']);

});

Route::group(['middleware' => 'roles', 'roles'=>['User', 'Admin', 'Editor']], function() {
    Route::post('/like', [App\Http\Controllers\pagescontroller::class, 'like'])->name('like');
    Route::post('/dislike', [App\Http\Controllers\pagescontroller::class, 'dislike'])->name('dislike');

});




//test

/*
Route::get('/admin', [
    'uses' => 'App\Http\Controllers\pagesController@admin',
    'as' =>'content.admin',
    'middleware' => 'roles',
    'roles' => ['admin']
]);
Route::post('/add-role', [
    'uses' => 'App\Http\Controllers\pagesController@addRole',
    'as' =>'content.admin',
    'middleware' => 'roles',
    'roles' => ['admin']
]);


Route::get('/editor', [
    'uses' => 'App\Http\Controllers\pagesController@editor',
    'as' =>'content.editor',
    'middleware' => 'roles',
    'roles' => ['admin', 'editor']
]);

*/
