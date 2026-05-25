<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto_Assets extends Model
{
    /** @use HasFactory<\Database\Factories\CryptoAssetsFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coin_id',
        'symbol',
        'name',
        'amount',
        'avg_buy_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
