<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->integer('installment_number'); // Numéro de la tranche (1, 2, 3...)
            $table->decimal('amount', 12, 2)->default(0);
            $table->date('due_date');
            $table->string('status')->default('pending'); // pending, paid, overdue, cancelled
            $table->text('notes')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index(['project_id', 'installment_number']);
            $table->index('status');
            $table->index('due_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_schedules');
    }
};
