<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'image' => ['image', 'max:1024', 'nullable'],
            'link' => ['nullable', 'max:255', 'string'],
            'project_category_id' => [
                'required',
                'exists:project_categories,id',
            ],
            'status' => ['required', 'max:255'],
        ];
    }
}
