<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Insured extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_id',
        'product_id',
        'supplier_id',
        'number_of_terms',
        'start_date',
        'end_date',
        'status',
        'policy_number',
        'sum_insured',
        'premium',
        'rate',
        'policy_schedule_link',
        'commission_id',
        'commission_amount'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }


}
