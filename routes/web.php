<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin;

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

Route::get(
    '/',
    function () {
        return view('welcome');
    }
)->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get(
    '/dashboard',
    function () {
        return view('dashboard');
    }
)->name('dashboard');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'can:access-admin'], function() {
    Route::get('/', function() { return redirect()->route('admin.dashboard'); });
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::resource('menus', \App\Http\Controllers\MenuController::class);
    Route::resource('menus.items', \App\Http\Controllers\MenuItemController::class);
    Route::resource('pages', Admin\PageController::class);
});

Route::get('/{page:slug}', [\App\Http\Controllers\PageController::class, 'show'])->name('pages.show');
Route::get('/{page:slug}/{post:slug}', [\App\Http\Controllers\PostController::class, 'show'])->name(
    'pages.posts.show'
);
