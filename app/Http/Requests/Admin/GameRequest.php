<?php

namespace App\Http\Requests\Admin;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $companyIds = Company::pluck('id')->map(fn($id) => (string) $id)->implode(',');

        return [
            'title' => 'required|string|max:255',

            'developer_mode' => 'required|in:existing,new',
            'developer_existing_id' => 'required_if:developer_mode,existing|nullable|in:' . $companyIds,
            'developer_name' => 'required_if:developer_mode,new|nullable|string|max:255|unique:companies,name',
            'developer_image' => 'nullable|image|max:2048',

            'publisher_mode' => 'required|in:existing,new',
            'publisher_existing_id' => 'required_if:publisher_mode,existing|nullable|in:' . $companyIds,
            'publisher_name' => 'required_if:publisher_mode,new|nullable|string|max:255|unique:companies,name',
            'publisher_image' => 'nullable|image|max:2048',

            'thumbnail' => 'nullable|image|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ];
    }
}
