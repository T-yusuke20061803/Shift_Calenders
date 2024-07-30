<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\readerController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/calendar', [EventController::class, 'show'])->name('show');//参照
Route::post('/calendar/create', [EventController::class, 'create'])->name('create');//予定新規追加
Route::post('/calendar/get', [EventController::class, 'get'])->name('get');//DBに登録した予定を取得
Route::put('/calendar/update', [EventController::class, 'update'])->name('update');
Route::delete('/calendar/delete', [EventController::class, 'delete'])->name('delete');

Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');

Route::middleware(['auth', 'reader'])->group(function () {//管理者専用ルート
    Route::get('/reader', [AdminController::class, 'index'])->name('reader.index');
    Route::get('/reader/users', [AdminController::class, 'manageUsers'])->name('reader.users');
    Route::post('/reader/users/{user}/update-role', [AdminController::class, 'updateUserRole'])->name('reader.users.updateRole');
});

Route::get('/calendar/', [ShiftController::class, 'shifts'])->name('shift');