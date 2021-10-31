<?php

namespace App\Http\Controllers\Public\Reservations\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return !auth()->guest();
    }

    public function rules(): array
    {
        return [
            'date_start'=> [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:' . date('Y-m-d'),
            ],
            'date_end' => [
                'required',
                'date_format:Y-m-d',
                'after:date_start'
            ],
            'price' => [
                'required',
                'numeric',
                'min:1',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'date_start.required' => __('public/pages/apartment.form.validate_messages.date_start.required'),
            'date_start.date_format' => __('public/pages/apartment.form.validate_messages.date_start.format'),
            'date_start.after_or_equal' => __('public/pages/apartment.form.validate_messages.date_start.after_or_equal'),

            'date_end.required' => __('public/pages/apartment.form.validate_messages.date_end.required'),
            'date_end.date_format' => __('public/pages/apartment.form.validate_messages.date_end.format'),
            'date_end.after' => __('public/pages/apartment.form.validate_messages.date_end.after'),
        ];
    }
}
