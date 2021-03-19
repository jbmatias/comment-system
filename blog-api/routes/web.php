<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blog\PostController;
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

Route::group([
    'middleware' => ['cors'],
    'namespace' => 'Blog',    
], function ($router) {
    Route::post('/save/username', [PostController::class, 'saveName'])->name('login');
    Route::get('/posts', [PostController::class, 'getPost'])->name('login');    
});