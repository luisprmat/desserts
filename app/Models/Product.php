<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;

class Product extends Model
{
    public function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => Number::currency($this->price_cents / 100, 'USD'),
        );
    }
}
