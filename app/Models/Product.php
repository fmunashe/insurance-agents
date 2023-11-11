<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'product_category_id',
        'client_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class,'client_id','id');
    }

    public function insureds(): HasMany
    {
        return $this->hasMany(Insured::class);
    }

}
