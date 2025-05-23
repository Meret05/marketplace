<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function combinations()
    {
        return $this->hasMany(ProductVariationCombination::class, 'attribute_value_id');
    }

    public function storeAttributeValues()
    {
        return $this->attribute
            ->whereHas('store', function ($q) {
                $q->where('user_id', auth()->user()->id);
            })
            ->get();
    }
}
