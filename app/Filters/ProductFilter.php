<?php

namespace App\Filters;

class ProductFilter extends QueryFilter{
    public function search_field($search_string = ''){
        return $this->builder
            ->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($search_string) . '%'])
            ->orWhere('sku', 'LIKE', $search_string);
    }

    public function category_id($ids = null)
    {
        return $this->builder->when($ids, function ($query) use ($ids) {
            $query->whereIn('category_id', (array) $ids);
        });
    }

    public function store_id($ids = null){
        return $this->builder->when($ids, function($query) use($ids){
            $query->where('store_id', (array) $ids);
        });
    }

    public function price_range($range = null)
    {
        return $this->builder->when($range, function ($query) use ($range) {
            $query->whereHas('variations', function ($q) use ($range) {
                if (isset($range['min'])) {
                    $q->where('price', '>=', $range['min']);
                }
                if (isset($range['max'])) {
                    $q->where('price', '<=', $range['max']);
                }
            });
        });
    }

    public function sort_price($direction = 'asc')
    {
        return $this->builder
            ->withMin('variations', 'price')
            ->orderBy('variations_min_price', $direction);
    }
}
