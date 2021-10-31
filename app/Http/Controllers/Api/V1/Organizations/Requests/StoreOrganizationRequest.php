<?php

namespace App\Http\Controllers\Api\V1\Organizations\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $organization_id = $this
            ->route()
            ->parameter('id');

        return [
            'name' => 'required',
            'slug' => [
                'required',
                'unique:organizations,slug,' . $organization_id ?? '',
            ],
            'phone' => 'required',
            'email' => [
                'required',
                'email',
            ],
        ];
    }
}
