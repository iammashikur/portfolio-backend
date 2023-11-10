<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceUpdateRequest extends FormRequest
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
            'company' => ['required', 'max:255', 'string'],
            'designation' => ['required', 'max:255', 'string'],
            'from_date' => ['required', 'date'],
            'to_date' => ['required', 'date'],
            'status' => ['required', 'max:255'],
        ];
    }
}
