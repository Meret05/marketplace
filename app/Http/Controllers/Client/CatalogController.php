<?php

namespace App\Http\Controllers\Client;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::with('image')->get();

        return view('client.catalog.index', compact('catalogs'));
    }

    public function show(Catalog $catalog, ProductFilter $request)
    {
        $stores = Store::all();
        $categories = $catalog->categories()->whereHas('products')->get();

        if ($request) {
            $products = $catalog->products()->filter($request)->with('images', 'category')->paginate(12)->withQueryString();
        }
        else {
            $products = $catalog->products()->with('category','images')->get();
        }
        return view('client.catalog.show', compact('catalog', 'products', 'categories', 'stores'));
    }
}
