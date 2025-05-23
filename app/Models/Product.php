<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class)->where('user_id', auth()->user()->id);
    }

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    public function getMinPriceAttribute()
    {
        return $this->variations->min('price');
    }

    public function getMaxPriceAttribute()
    {
        return $this->variations->max('price');
    }

    public function usedAttributesWithValues()
    {
        return Attribute::with('values')
            ->whereHas('values.combinations.variation', function ($q) {
                $q->where('product_id', $this->id);
            })
            ->get();
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter){
        return $filter->apply($builder);
    }

}
