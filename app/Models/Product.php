<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function receivings(): HasMany
    {
        return $this->hasMany(StockReceiving::class, 'product_id', 'id');
    }

}
