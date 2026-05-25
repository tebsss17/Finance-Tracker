<?php

use App\Models\Accounts;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Accounts::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Categories::class)->constrained()->cascadeOnDelete();
            $table->enum('type', ['expense', 'income', 'transfer', 'buy crypto', 'sell crypto',]);
            $table->decimal('amount', 15, 2);
            $table->string('currency', 10)->default('PHP');
            $table->text('description')->nullable();
            $table->string('reference')->nullable();
            $table->date('transaction_date');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
