<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_id' => 'required|integer|exists:companies,id',
            'office_id' => 'required|integer|exists:locations,id',
            'pr_number' => 'required|string|max:255',
            'date' => 'required|date',
            'property_number' => 'nullable|string|max:255',
            'unit' => 'nullable|string|max:100',
            'item_description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'unit_cost' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'grand_total' => 'required|numeric|min:0',
            'purpose' => 'required|string',
            'requested_by' => 'required|integer|exists:users,id',
        ];
    }
}
