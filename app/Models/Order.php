<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
