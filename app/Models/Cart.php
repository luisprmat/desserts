<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Number;

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

    public function quantityOf(Product $product): int
    {
        return $this->items->firstWhere('product_id', $product->id)->quantity ?? 0;
    }

    public function totalItemsCount(): int
    {
        return $this->items->sum('quantity');
    }

    public function formattedTotal()
    {
        $total = $this->items->sum(fn ($item) => $item->product->price_cents * $item->quantity);

        return Number::currency($total / 100, 'USD');
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
