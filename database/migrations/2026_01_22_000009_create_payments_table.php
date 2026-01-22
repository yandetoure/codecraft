<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('payment_schedule_id')->nullable();
            $table->string('payment_number')->unique();
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('payment_method')->default('wave'); // wave
            $table->string('transaction_id')->nullable()->unique();
            $table->string('status')->default('pending'); // pending, completed, failed, refunded
            $table->json('gateway_response')->nullable(); // Réponse complète de Wave
            $table->text('notes')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('invoice_id');
            $table->index('transaction_id');
            $table->index('payment_schedule_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
