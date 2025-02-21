<?php

namespace App\Services;

use App\Http\Requests\TourRequest\TourIndexRequest;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourService extends CrudBaseService
{
    public function __construct(Tour $tourModel)
    {
        $this->model = $tourModel;
    }

    public function getTours(TourIndexRequest $request)
    {
        return $this->model
            ->filter($request->validated())
            ->customPaginate();
    }

    public function createTour(array $validatedData)
    {
        return $this->model::create($validatedData);
    }

    public function getTour(Tour $tour)
    {
        return $tour;
    }

    public function updateTour(Tour $tour, array $validatedData)
    {
        $tour->update($validatedData);
        return $tour;
    }

    public function deleteTour(Tour $tour)
    {
        $tour->delete();
        return $tour;
    }
}
