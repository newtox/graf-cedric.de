<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:companies,name' . ($this->company ? ',' . $this->company->id : ''),
            'image' => 'nullable|image|max:2048',
        ];
    }
}
