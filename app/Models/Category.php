<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class);
    }

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getBreadcrumbs()
    {
        $breadcrumbs = collect([]);

        $category = $this;
        while ($category) {
            $breadcrumbs->prepend($category); // добавляет в начало
            $category = $category->parent;
        }

        // В начало добавим сам каталог
        if ($this->catalog) {
            $breadcrumbs->prepend($this->catalog);
        }

        return $breadcrumbs;
    }


}
