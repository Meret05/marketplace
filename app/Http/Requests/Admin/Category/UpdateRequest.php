<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'catalog_id' => 'required|string|exists:catalogs,id',
            'parent_id' => 'nullable|integer|exists:categories,id'
        ];
    }
}
