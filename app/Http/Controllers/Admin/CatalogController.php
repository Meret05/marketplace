<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Catalog\StoreRequest;
use App\Http\Requests\Admin\Catalog\UpdateRequest;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{

    public function index()
    {
        $catalogs = Catalog::all();
        return view('admin.catalog.index', compact('catalogs'));
    }

    public function create()
    {
        return view('admin.catalog.create');
    }

    public function store(StoreRequest $request)
    {
        $data = collect($request->validated())->except('images')->toArray();
        $catalog = Catalog::create($data);

        $image = $request['image'];

        if ($request->hasFile('image')) {
            $path = $image->store('images', 'public');
            $catalog->image()->create(['path' => $path]);
        }

        return redirect()->back();
    }

    public function show(Catalog $catalog)
    {
        $image = $catalog->image;
        return view('admin.catalog.show', compact('catalog', 'image'));
    }

    public function edit(Catalog $catalog)
    {
        $image = $catalog->image;
        return view('admin.catalog.edit', compact('catalog', 'image'));
    }

    public function update(UpdateRequest $request, Catalog $catalog)
    {
        $image = $catalog->image;
        if ($image) {
            $image->delete();
            Storage::disk('public')->delete($image->path);
        }
        $data = collect($request->validated())->except('image')->toArray();
        $catalog->update($data);
        $image = $request['image'];

        if ($request->hasFile('image')) {
            $path = $image->store('images', 'public');
            $catalog->image()->create(['path' => $path]);
        }
        $catalog->fresh();
        return redirect()->back();
    }

    public function destroy(Catalog $catalog)
    {
        $image = $catalog->image;
        if ($image) {
            $image->delete();
            Storage::disk('public')->delete($image->path);
        }
        $catalog->delete();
        return redirect()->back();
    }
}
