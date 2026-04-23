<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public static function ifExists(): ?static
    {
        return self::with('items.product')
            ->where('session_id', session()->getId())
            ->first();
    }
}
