<?php

namespace App\Services;

use App\Http\Requests\HotelRequest\HotelIndexRequest;
use App\Models\Hotel;

class HotelService extends CrudBaseService
{
    public function __construct(Hotel $hotelModel)
    {
        $this->model = $hotelModel;
    }

    public function getHotels(HotelIndexRequest $request)
    {
        return $this->model
            ->filter($request->validated())
            ->customPaginate();
    }

    public function createHotel(array $validatedData)
    {
        return $this->model::create($validatedData);
    }

    public function getHotel(Hotel $hotel)
    {
        return $hotel;
    }

    public function updateHotel(Hotel $hotel, array $validatedData)
    {
        $hotel->update($validatedData);
        return $hotel;
    }

    public function deleteHotel(Hotel $hotel)
    {
        $hotel->delete();
        return $hotel;
    }
}
