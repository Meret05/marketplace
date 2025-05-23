<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Store\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function create()
    {
        return view('seller.store.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $data['user_id'] = $user->id;
        $user->is_seller = true;
        $user->save();
        Store::create($data);

        return redirect()->route('seller.products.index');
    }
}
