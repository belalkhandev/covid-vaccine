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
        Schema::create('vaccine_center_dosages', function (Blueprint $table) {
            $table->foreignId('vaccine_center_id')->constrained('vaccine_centers');
            $table->foreignId('vaccine_dosage_id')->constrained('vaccine_dosages');
            $table->primary(['vaccine_center_id', 'vaccine_dosage_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccine_center_dosages');
    }
};
