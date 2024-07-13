<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;

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

Route::get('/', [EventController::class, 'show'])->name('show');//参照
Route::post('/create', [EventController::class, 'create'])->name('create');//予定新規追加
Route::post('/get', [EventController::class, 'get'])->name('get');//DBに登録した予定を取得
Route::put('/update', [EventController::class, 'update'])->name('update');
Route::delete('/delete', [EventController::class, 'delete'])->name('delete');

Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
