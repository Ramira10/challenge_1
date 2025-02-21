<?php

namespace App\Http\Requests\BookingRequest;

use Illuminate\Foundation\Http\FormRequest;

class BookingIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracty dos\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'tour_name' => 'nullable|string|max:255',
            'hotel_name' => 'nullable|string|max:255',
            'customer_name' => 'nullable|string|max:255',
            'order_by' => 'nullable|in:booking_date,customer_name,tour_name,hotel_name',
            'order_direction' => 'nullable|in:asc,desc',
            'status' => 'nullable|in:Pendiente,Aceptada,Cancelada',
        ];
    }
}
