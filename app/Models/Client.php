<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
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
}
