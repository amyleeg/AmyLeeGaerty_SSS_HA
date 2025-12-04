<?php

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
        Schema::create('pattern_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pattern_id')->constrained()->cascadeOnDelete();
            $table->string('size_label');        
            $table->string('measurements')->nullable(); 
            $table->string('pdf_path')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pattern_sizes');
    }
};
