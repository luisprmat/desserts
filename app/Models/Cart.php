<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['session_id'])]
class Cart extends Model
{
    use MassPrunable;

    public function prunable(): Builder
    {
        return static::where('updated_at', '<=', now()->subHours(2));
    }

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

    public static function ensureExists(): static
    {
        return self::firstOrCreate([
            'session_id' => session()->getId(),
        ]);
    }

    public function incrementItem(Product $product): void
    {
        $this->items()->firstOrCreate([
            'product_id' => $product->id,
        ], [
            'quantity' => 0,
        ])->increment('quantity');
    }
}
