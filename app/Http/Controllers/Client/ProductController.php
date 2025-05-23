<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request, Product $product)
    {
        $currentProduct = Product::with('category')->findOrFail($product->id);

        $similarProducts = Product::with('images', 'variations')
            ->where('category_id', $currentProduct->category_id)
            ->where('id', '!=', $currentProduct->id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        $attributes = $product->usedAttributesWithValues();
        $attributesArray = $attributes->toArray();
        $variation = null;

        $category = $product->category;

        $selectedAttributes = $request->input('attributes', []);

//        if (!$attributesArray) {
//            $variation = $product->variations;
//        }

        if (count($selectedAttributes) > 0 && !in_array(null, $selectedAttributes)) {
            $variation = Variation::where('product_id', $product->id)
                ->whereHas('combinations', function ($query) use ($selectedAttributes) {
                    $query->whereIn('attribute_value_id', array_values($selectedAttributes));
                }, '=', count($selectedAttributes))
                ->with('combinations.attributeValue.attribute')
                ->first();
        }

        $breadcrumbs = $category->getBreadcrumbs();
        $images = $product->images;
        $variations = $product->variations()->with('combinations')->get();
        $previewImage = $images->first();

        return view('client.product.show', compact('similarProducts', 'previewImage', 'product', 'images', 'variations', 'breadcrumbs', 'attributes', 'variation', 'selectedAttributes', 'attributesArray'));
    }
}
