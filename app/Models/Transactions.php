<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionsFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'accounts_id',
        'categories_id',
        'type',
        'amount',
        'currency',
        'description',
        'reference',
        'transaction_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function account()
    {
        return $this->belongsTo(Accounts::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
