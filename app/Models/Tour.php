<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'start_date',
        'end_date',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeFilter($query, $filters)
    {
        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        if (!empty($filters['min_start_date'])) {
            $query->where('start_date', '>=', $filters['min_start_date']);
        }

        if (!empty($filters['max_end_date'])) {
            $query->where('end_date', '<=', $filters['max_end_date']);
        }

        if (!empty($filters['name'])) {
            $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
        }

        return $query;
    }
}
