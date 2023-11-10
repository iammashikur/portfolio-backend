<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QualificationStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'School' => ['required', 'max:255', 'string'],
            'from_date' => ['required', 'date'],
            'to_date' => ['required', 'date'],
            'degree' => ['required', 'max:255', 'string'],
            'status' => ['required', 'max:255'],
        ];
    }
}
