<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;

// Additional routes
// !!! Lo ideal seria modularizar correctamente las rutas, pero por falta de tiempo las coloque directamente aca.  !!!
Route::get('/bookings/export', [BookingController::class, 'export']);
Route::put('/bookings/{booking}/cancel', [BookingController::class, 'cancel']);

Route::apiResource('tours', TourController::class);
Route::apiResource('hotels', HotelController::class);
Route::apiResource('bookings', BookingController::class);
