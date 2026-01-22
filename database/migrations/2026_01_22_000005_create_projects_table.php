<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_number')->unique();
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('pack_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('domain_name')->nullable();
            $table->text('description')->nullable();
            $table->text('client_notes')->nullable(); // Notes du client
            $table->text('admin_notes')->nullable(); // Notes internes admin
            $table->string('status')->default('demande'); // demande, devis_envoye, en_attente_paiement, en_cours, en_maintenance, termine, annule
            $table->decimal('base_price', 12, 2)->default(0);
            $table->decimal('features_price', 12, 2)->default(0);
            $table->decimal('total_price', 12, 2)->default(0);
            $table->string('payment_type')->default('total'); // total, installment
            $table->foreignId('created_by_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('client_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
