<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
