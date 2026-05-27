<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriesFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'icon',
    ];

    public function transactions()
    {
        return $this->hasMany(Transactions::class);
    }

    public function budgets()
    {
        return $this->hasMany(Budgets::class);
    }
}
