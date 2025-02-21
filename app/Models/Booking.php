<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Booking extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tour_id',
        'hotel_id',
        'customer_name',
        'customer_email',
        'number_of_people',
        'booking_date',
        'status'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function scopeFilter($query, $filters)
    {
        if (!empty($filters['start_date'])) {
            $query->where('booking_date', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->where('booking_date', '<=', $filters['end_date']);
        }

        if (!empty($filters['customer_name'])) {
            $query->whereRaw('LOWER(customer_name) LIKE ?', ['%' . strtolower($filters['customer_name']) . '%']);
        }

        if (!empty($filters['tour_name'])) {
            $query->whereHas('tour', function ($q) use ($filters) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($filters['tour_name']) . '%']);
            });
        }

        if (!empty($filters['hotel_name'])) {
            $query->whereHas('hotel', function ($q) use ($filters) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($filters['hotel_name']) . '%']);
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['order_by']) && !empty($filters['order_direction'])) {
            $orderBy = $filters['order_by'];
            $direction = $filters['order_direction'];

            if ($orderBy === 'hotel_name') {
                $query->join('hotels', 'hotels.id', '=', 'bookings.hotel_id')
                    ->orderBy('hotels.name', $direction)
                    ->select('bookings.*');
            } elseif ($orderBy === 'tour_name') {
                $query->join('tours', 'tours.id', '=', 'bookings.tour_id')
                    ->orderBy('tours.name', $direction)
                    ->select('bookings.*');
            } else {
                $query->orderBy($orderBy, $direction);
            }
        }


        return $query;
    }
}
