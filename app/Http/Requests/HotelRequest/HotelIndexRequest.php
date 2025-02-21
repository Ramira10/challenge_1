<?php

namespace App\Http\Requests\HotelRequest;

use Illuminate\Foundation\Http\FormRequest;

class HotelIndexRequest extends FormRequest
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
            'min_rating' => 'nullable|numeric|min:0|max:5',
            'max_rating' => 'nullable|numeric|min:0|max:5',
            'min_price'  => 'nullable|numeric|min:0',
            'max_price'  => 'nullable|numeric|min:0',
            'name'        => 'nullable|string|max:255',
            'address'     => 'nullable|string|max:255',
        ];
    }
}
