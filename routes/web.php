<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin', function(){
    //we are using the function because we are not loading via controller
    return view('admin');
})->name('admin')->middleware('admin');

Route::get('staff', function(){
    //we are using the function because we are not loading via controller
    return view('staff');
})->name('staff')->middleware('staff');

Route::get('client', function(){
    //we are using the function because we are not loading via controller
    return view('client');
})->name('client')->middleware('client');