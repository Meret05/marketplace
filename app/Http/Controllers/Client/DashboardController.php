<?php

namespace App\Http\Controllers\Client;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Product;
use App\Models\User;
use App\Models\Variation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::with('images', 'variations')->latest()->take(12)->get();

        return view('client.dashboard.index', compact('products',));
    }
}
