<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttributeValue\StoreRequest;
use App\Http\Requests\Admin\AttributeValue\UpdateRequest;
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
        $attributeValues = AttributeValue::with('attribute')->get();
        return view('admin.attribute-value.index', compact('attributeValues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributes = Attribute::all();
        return view('admin.attribute-value.create', compact('attributes'));
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
        return view('admin.attribute-value.edit', compact('attributes', 'attributeValue'));

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
