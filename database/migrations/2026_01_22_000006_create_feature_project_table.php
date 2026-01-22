<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('feature_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('feature_id')->constrained()->cascadeOnDelete();
            $table->decimal('price', 12, 2)->default(0); // Prix au moment de l'ajout
            $table->timestamps();

            $table->unique(['project_id', 'feature_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feature_project');
    }
};
