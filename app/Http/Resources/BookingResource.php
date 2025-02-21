<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->loadMissing(['hotel', 'tour']);

        return [
            'id' => $this->id,
            'tour' => $this->whenLoaded('tour', [
                'id' => $this->tour->id,
                'name' => $this->tour->name,
            ]),
            'hotel' => $this->whenLoaded('hotel', [
                'id' => $this->hotel->id,
                'name' => $this->hotel->name,
            ]),
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'number_of_people' => $this->number_of_people,
            'booking_date' => $this->booking_date,
            'status' => $this->status,
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }
}
