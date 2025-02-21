<?php

namespace App\Services;

use App\Mail\BookingConfirmation;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;

class EmailService
{

    public static function sendMail(Booking $booking)
    {
        Mail::to($booking->customer_email)
            ->send(new BookingConfirmation($booking));
    }
}
