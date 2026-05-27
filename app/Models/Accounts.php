<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    /** @use HasFactory<\Database\Factories\AccountsFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'provider',
        'balance',
        'currency',
        'is_active',
        'icon'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transactions::class);
    }
}
