<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Variation\StoreRequest;
use App\Http\Requests\Admin\Variation\UpdateRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\Variation;
use App\Models\ProductVariationCombination;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        $attributes = Attribute::with('values')->get();

        return view('admin.product-variation.create', compact('product', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $filteredAttributes = array_filter($data['attributes']);

        $attributeValues = [];
        if (!empty($filteredAttributes)) {
            foreach ($filteredAttributes as $valueId) {
                $attribute = AttributeValue::find($valueId); // Замените на вашу модель атрибутов
                if ($attribute) {
                    $attributeValues[] = $attribute->value; // Предположим, что у атрибута есть поле `value`
                }
            }
        }

        if (empty($attributeValues)) {
            do {
                $rand = rand(1000000, 9999999);
                $sku = $rand;
            } while (Variation::where('sku', $sku)->exists());
        }
        else {
            do {
                $rand = rand(1000000, 9999999);
                $sku = $rand . '-' . implode('-', $attributeValues);
            } while (Variation::where('sku', $sku)->exists());
        }

        $variation = Variation::create([
            'product_id' => $data['product_id'],
            'sku' => $sku,
            'price' => $data['price'],
            'quantity' => $data['quantity'],
        ]);


        if (!empty($filteredAttributes)) {
            foreach ($filteredAttributes as $valueId) {
                ProductVariationCombination::create([
                    'variation_id' => $variation->id,
                    'attribute_value_id' => $valueId,
                ]);
            }
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Variation $variation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($productId, Variation $variation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Variation $variation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variation $variation)
    {
        ProductVariationCombination::where('variation_id', $variation->id)->delete();

        $variation->delete();


        return redirect()->back();
    }
}
