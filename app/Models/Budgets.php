<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budgets extends Model
{
    /** @use HasFactory<\Database\Factories\BudgetsFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'categories_id',
        'amount_limit',
        'month',
        'year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
