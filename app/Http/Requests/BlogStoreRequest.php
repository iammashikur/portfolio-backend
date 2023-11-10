<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
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
            'image' => ['nullable', 'image', 'max:1024'],
            'title' => ['required', 'max:255', 'string'],
            'content' => ['required', 'max:255', 'string'],
            'keywords' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'blog_category_id' => ['required', 'exists:blog_categories,id'],
            'status' => ['required', 'max:255'],
        ];
    }
}
