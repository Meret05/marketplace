<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function get()
    {
        return self::where(['session_id' => session()->getId()])->get();
    }

    public static function count()
    {
        return self::where(['session_id' => session()->getId()])->sum('quantity');
    }

    public static function add($variation_id)
    {
        $variation = Variation::findOrFail($variation_id);

        if ($cart = self::where(['session_id' => session()->getId(), 'variation_id' => $variation->id])->first()) {
            $cart->quantity++;
            $cart->save();
        } else {
            $cart = self::create([
                'session_id' => session()->getId(),
                'variation_id' => $variation->id,
                'quantity' => 1,
                'price' => $variation->price
            ]);
        }

        return $cart;
    }

    public static function quantity($id, $quantity)
    {
        if ($quantity <= 0) {
            return self::remove($id);
        }

        $cart = self::findOrFail($id);

        $cart->quantity = $quantity;
        $cart->save();

        return $cart;
    }

    public static function remove($id)
    {
        return self::destroy($id);
    }

    public static function flush()
    {
        return self::where(['session_id' => session()->getId()])->delete();
    }


    public static function total()
    {
        return self::where(['session_id' => session()->getId()])->get()->map(function ($item) {
            return $item->price * $item->quantity;
        })->sum();
    }

    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
}
