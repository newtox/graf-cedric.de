<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'developer_name' => 'required|string|max:255',
            'developer_image' => 'nullable|image|max:2048',
            'publisher_name' => 'required|string|max:255',
            'publisher_image' => 'nullable|image|max:2048',
            'thumbnail' => 'nullable|image|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ];
    }
}
