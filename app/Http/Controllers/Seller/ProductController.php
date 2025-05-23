<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Product\StoreRequest;
use App\Http\Requests\Seller\Product\UpdateRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = auth()->user()->store->products;

        return view('seller.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('seller.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = collect($request->validated())->except('images')->toArray();
        $data['store_id'] = auth()->user()->store->id;

        do {
            $sku = rand(1000000, 9999999);
        } while (Product::where('sku', $sku)->exists());

        $data['sku'] = $sku;

        $product = Product::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $product->images()->create(['path' => $path]);
            }
        }

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $store = $product->store;
        $images = $product->images;

        return view('seller.product.show', compact('product', 'store', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $images = $product->images;
        $categories = Category::all();
        return view('seller.product.edit', compact('product', 'images', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $data = collect($request->validated())->except('images')->toArray();
        $product->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $product->images()->create(['path' => $path]);
            }
        }

        $product->fresh();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);

        }
        $product->delete();
        return redirect()->back();
    }
}
