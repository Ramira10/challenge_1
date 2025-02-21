<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest\BookingIndexRequest;
use App\Http\Requests\BookingRequest\BookingStoreRequest;
use App\Http\Requests\BookingRequest\BookingUpdateRequest;
use App\Http\Resources\BookingCollection;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Services\BookingService;
use App\Exports\BookingsExport;
use Maatwebsite\Excel\Facades\Excel;

class BookingController extends Controller
{
    private BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(BookingIndexRequest $request)
    {
        $bookings = $this->bookingService->getBookings($request);
        return new BookingCollection($bookings);
    }

    public function store(BookingStoreRequest $request)
    {
        $validatedData = $request->validated();
        $booking = $this->bookingService->createBooking($validatedData);
        return new BookingResource($booking);
    }

    public function show(Booking $booking)
    {
        $booking = $this->bookingService->getBooking($booking);
        return new BookingResource($booking);
    }

    public function update(BookingUpdateRequest $request, Booking $booking)
    {
        $validatedData = $request->validated();
        $booking = $this->bookingService->updateBooking($booking, $validatedData);
        return new BookingResource($booking);
    }

    public function destroy(Booking $booking)
    {
        $this->bookingService->deleteBooking($booking);

        return response()->json([
            'message' => 'Booking successfully deleted',
            'data' => new BookingResource($booking)
        ]);
    }

    public function export()
    {
        return Excel::download(new BookingsExport, 'bookings.csv');
    }

    public function cancel(Booking $booking)
    {
        $updatedBooking = $this->bookingService->cancelBooking($booking);

        if ($updatedBooking) {
            return response()->json([
                'message' => 'Booking successfully cancelled',
                'data' => new BookingResource($updatedBooking)
            ]);
        }

        return response()->json([
            'message' => 'Booking is already cancelled',
        ], 400);
    }
}
