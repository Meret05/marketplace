<?php

namespace App\Http\Requests\Admin\Variation;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'sku' => 'nullable|unique:variations,sku',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'attributes' => 'nullable|array',
            'attributes.*' => 'nullable|exists:attribute_values,id',
        ];
    }
}
