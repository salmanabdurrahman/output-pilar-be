<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('cars', [CarController::class, 'index']);
Route::get('cars/popular', [CarController::class, 'popular']);
Route::get('cars/{id}', [CarController::class, 'show']);
Route::get('cars/search', [CarController::class, 'search']);

Route::get('bookings/{id}', [BookingController::class, 'show']);
Route::post('bookings', [BookingController::class, 'store'])->middleware('auth:sanctum');

Route::get('transactions/{id}', [TransactionController::class, 'show'])->middleware('auth:sanctum');
