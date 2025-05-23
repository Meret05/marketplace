<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\AttributeValue\StoreRequest;
use App\Http\Requests\Seller\AttributeValue\UpdateRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributeValues = AttributeValue::with('attribute')
            ->whereHas('attribute.store', function ($q) {
                $q->where('user_id', auth()->user()->id);
            })
            ->get();

        return view('seller.attribute-value.index', compact('attributeValues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributes = auth()->user()->store->attributes;
        return view('seller.attribute-value.create', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        AttributeValue::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttributeValue $attributeValue)
    {
        $attributes = Attribute::all();
        return view('seller.attribute-value.edit', compact('attributes', 'attributeValue'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, AttributeValue $attributeValue)
    {
        $data = $request->validated();

        $attributeValue->update($data);
        $attributeValue->fresh();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttributeValue $attributeValue)
    {
        $attributeValue->delete();

        return redirect()->back();
    }
}
