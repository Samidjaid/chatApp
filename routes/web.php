<?php

use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\ImageController;


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

Route::get('/chatroom', [ChatRoomController::class, 'chatRoom'])->name('home');
Route::post('/chatroom', [ChatRoomController::class, 'createMessage'])->name('createMessage');

Route::get('/', [Auth::class, 'login'])->name('login');
Route::post('/', [Auth::class, 'loginPost'])->name('loginPost');

Route::get('/register', [Auth::class, 'register'])->name('register');
Route::post('/register', [Auth::class, 'registerPost'])->name('registerPost');
Route::get('/logout', [Auth::class, 'logout'])->name('logout');




