<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourRequest\TourIndexRequest;
use App\Http\Requests\TourRequest\TourStoreRequest;
use App\Http\Requests\TourRequest\TourUpdateRequest;
use App\Http\Resources\TourCollection;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use App\Services\TourService;

class TourController extends Controller
{
    private TourService $tourService;

    public function __construct(TourService $tourService)
    {
        $this->tourService = $tourService;
    }

    public function index(TourIndexRequest $request)
    {
        $tours = $this->tourService->getTours($request);
        return new TourCollection($tours);
    }

    public function store(TourStoreRequest $request)
    {
        $validatedData = $request->validated();
        $tour = $this->tourService->createTour($validatedData);

        return new TourResource($tour);
    }

    public function show(Tour $tour)
    {
        return new TourResource($tour);
    }

    public function update(TourUpdateRequest $request, Tour $tour)
    {
        $validatedData = $request->validated();
        $updatedTour = $this->tourService->updateTour($tour, $validatedData);

        return new TourResource($updatedTour);
    }

    public function destroy(Tour $tour)
    {
        $this->tourService->deleteTour($tour);
        return response()->json(null, 204);
    }
}
