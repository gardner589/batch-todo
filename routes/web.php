<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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
    return view('todo');
});
Route::get('/meee', function () {
    $user = \App\Models\User::find(1);
    auth()->login($user);
});
Route::get('/meee2', function () {
    $user = \App\Models\User::find(1);
    auth()->logout($user);
});

Route::get('/todo', [TodoController::class, 'index']);
Route::post('/todo/{todo}/update', [TodoController::class, 'update']);
Route::post('/todo/new', [TodoController::class, 'store']);
Route::get('/todo/{todo}', [TodoController::class, 'show']);
Route::put('/todo/{todo}', [TodoController::class, 'completed']);
Route::delete('/todo/{todo}', [TodoController::class, 'destroy']);



Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
