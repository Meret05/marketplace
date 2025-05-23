<?php

namespace App\Http\Controllers\Client;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(ProductFilter $request)
    {
        $products = Product::filter($request)->with('images', 'variations')->paginate(12)->withQueryString();

        return view('client.search.index', compact('products'));
    }
}
