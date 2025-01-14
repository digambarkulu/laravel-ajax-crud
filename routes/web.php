<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Crudcontroller;
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

Route::post('create-record',[Crudcontroller::class,'saveData']);
Route::get('fetch-record',[Crudcontroller::class,'fetchRecord']);
Route::post('delete-record',[Crudcontroller::class,'deleteRecord']);
Route::get('fetch-single-record/{id}',[Crudcontroller::class,'fetchSingleRecord']);
Route::put('save-edit-data',[Crudcontroller::class,'saveEditData']);

