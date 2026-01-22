<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('company_name')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('sms_number')->nullable();
            $table->string('email_sender')->nullable();
            $table->string('email_sender_name')->nullable();
            $table->json('additional_settings')->nullable(); // Paramètres supplémentaires spécifiques au projet
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_configurations');
    }
};
