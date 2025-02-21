<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use Carbon\Carbon;

// ESTO ES PARA VER LA VISTA DE MAIL !!
// localhost:PORT/preview-email
Route::get('/preview-email', function () {
    $booking = (object) [
        'customer_name' => 'Juan Pérez',
        'booking_date' => Carbon::parse('2025-02-20'),
        'number_of_people' => 2,
    ];

    $tour = new \App\Models\Tour([
        'name' => 'Tour a la playa',
    ]);

    $hotel = new \App\Models\Hotel([
        'name' => 'Hotel Sol',
    ]);

    $booking->tour = $tour;
    $booking->hotel = $hotel;

    return view('mail', compact('booking'));
});
