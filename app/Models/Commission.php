<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'commission_percentage',
        'product_category_id'
    ];

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function riskCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }
    public function insured(): HasMany
    {
        return $this->hasMany(Insured::class, 'commission_id', 'id');
    }


}
