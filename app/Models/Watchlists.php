<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlists extends Model
{
    /** @use HasFactory<\Database\Factories\WatchlistsFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coiin_id',
        'symbol',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
