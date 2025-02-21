<?php

namespace App\Services;

use App\Http\Requests\BookingRequest\BookingIndexRequest;
use App\Models\Booking;

class BookingService extends CrudBaseService
{
    public function __construct(Booking $bookingModel)
    {
        $this->model = $bookingModel;
    }

    public function getBookings(BookingIndexRequest $request)
    {
        return $this->model
            ->with(['tour', 'hotel'])
            ->filter($request->validated())
            ->customPaginate();
    }

    public function createBooking(array $validatedData)
    {
        $booking = $this->model::create($validatedData);

        if ($booking) {
            $booking->load('tour', 'hotel');

            EmailService::sendMail($booking);
        }

        return $booking;
    }

    public function getBooking(Booking $booking)
    {
        return $booking;
    }

    public function updateBooking(Booking $booking, array $validatedData)
    {
        $booking->update($validatedData);
        return $booking;
    }

    public function deleteBooking(Booking $booking)
    {
        $booking->delete();
        return $booking;
    }

    public function cancelBooking(Booking $booking)
    {
        if ($booking->status !== 'Cancelada') {
            $booking->update(['status' => 'Cancelada']);
            return $booking;
        }
        return null;
    }
}
