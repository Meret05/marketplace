<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Category::class, 'catalog_id', 'category_id');
    }
}
