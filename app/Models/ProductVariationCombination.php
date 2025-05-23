<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariationCombination extends Model
{
    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class);
    }

    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
}
