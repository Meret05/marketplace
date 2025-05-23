<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }
}
