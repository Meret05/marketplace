<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $catalogs = Catalog::all();
        $categories = Category::all();
        return view('admin.category.create', compact('categories', 'catalogs'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        return redirect()->back();
    }

    public function show(Category $category)
    {
        $catalog = $category->catalog;
        return view('admin.category.show', compact('category', 'catalog'));
    }

    public function edit(Category $category)
    {
        $categories = Category::all()->except($category->id);
        $catalogs = Catalog::all();
        $catalog = $category->catalog;
        return view('admin.category.edit', compact('category', 'categories', 'catalog', 'catalogs'));
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        $category->fresh();
        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
