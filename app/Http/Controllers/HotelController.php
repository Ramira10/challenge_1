<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest\HotelIndexRequest;
use App\Http\Requests\HotelRequest\HotelStoreRequest;
use App\Http\Requests\HotelRequest\HotelUpdateRequest;
use App\Http\Resources\HotelCollection;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use App\Services\HotelService;

class HotelController extends Controller
{
    private HotelService $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function index(HotelIndexRequest $request)
    {
        $hotels = $this->hotelService->getHotels($request);
        return new HotelCollection($hotels);
    }

    public function store(HotelStoreRequest $request)
    {
        $validatedData = $request->validated();
        $hotel = $this->hotelService->createHotel($validatedData);

        return new HotelResource($hotel);
    }

    public function show(Hotel $hotel)
    {
        return new HotelResource($hotel);
    }

    public function update(HotelUpdateRequest $request, Hotel $hotel)
    {
        $validatedData = $request->validated();
        $updatedHotel = $this->hotelService->updateHotel($hotel, $validatedData);

        return new HotelResource($updatedHotel);
    }

    public function destroy(Hotel $hotel)
    {
        $this->hotelService->deleteHotel($hotel);
        return response()->json(null, 204);
    }
}
