<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_aspirasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('input_aspirasi_id')->constrained('table_input_aspirasi')->cascadeOnDelete();
            $table->enum('status', ['menunggu', 'proses', 'selesai']);
            $table->foreignId('id_kategori')->constrained('table_kategori')->cascadeOnDelete();
            $table->integer('feedback')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_aspirasi');
    }
};
