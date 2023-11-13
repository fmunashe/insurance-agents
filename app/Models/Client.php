<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'email',
        'mobile',
        'gender',
        'id_number',
        'address',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
