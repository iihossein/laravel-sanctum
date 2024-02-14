<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskContrller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::resource('/tasks', TasksContrller::class);


// Public
Route::get('/login',[AuthController::class,'show']);
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::post('/register',[AuthController::class,'register'])->name('register');



// Protected

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('/tasks', TaskContrller::class);
    Route::post('/logout',[AuthController::class,'logout']);
});
