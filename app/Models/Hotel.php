<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'rating',
        'price_per_night',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeFilter($query, $filters)
    {
        if (!empty($filters['min_rating'])) {
            $query->where('rating', '>=', $filters['min_rating']);
        }

        if (!empty($filters['max_rating'])) {
            $query->where('rating', '<=', $filters['max_rating']);
        }

        if (!empty($filters['min_price'])) {
            $query->where('price_per_night', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price_per_night', '<=', $filters['max_price']);
        }

        if (!empty($filters['name'])) {
            $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['address'])) {
            $query->where('address', 'LIKE', '%' . $filters['address'] . '%');
        }

        return $query;
    }
}
