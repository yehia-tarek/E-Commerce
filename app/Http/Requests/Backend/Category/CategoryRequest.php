<?php

namespace App\Http\Requests\Backend\Category;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:categories,name,' . $this->category,
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'is_active' => 'nullable|in:on',
        ];
    }

    public function validatedData(): array
    {
        $validated = $this->validated();

        $data = [
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'parent_id' => $validated['parent_id'],
            'description' => $validated['description'],
            'is_active' => isset($validated['is_active']) ? 1 : 0
        ];

        return $data;
    }
}
