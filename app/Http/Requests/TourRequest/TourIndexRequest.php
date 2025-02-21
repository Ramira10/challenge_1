<?php

namespace App\Http\Requests\TourRequest;

use Illuminate\Foundation\Http\FormRequest;

class TourIndexRequest extends FormRequest
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
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'min_start_date' => 'nullable|date',
            'max_end_date' => 'nullable|date',
            'name' => 'nullable|string|max:255',
        ];
    }
}
