<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class,'index'])->name('home');

Route::resource('/category',CategoryController::class);
Route::resource('/item',ItemController::class);
Route::resource('/subcategory',SubCategoryController::class);
Route::resource('/photo',PhotoController::class);
Route::resource('/user',UserController::class)->middleware('admin');
Route::get('/',[PageController::class,'index'])->name('page.index');
Route::get('/detail',[PageController::class,'detail'])->name('page.detail');
Route::get('/itembysubcategory/{id}',[PageController::class,'itembysubcategory'])->name('page.itembysubcategory');



