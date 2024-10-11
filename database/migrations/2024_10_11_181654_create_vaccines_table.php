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
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vaccine_recipient_id')->constrained('vaccine_recipients')->cascadeOnDelete();
            $table->foreignId('vaccine_center_id')->constrained('vaccine_centers')->cascadeOnDelete();
            $table->foreignId('vaccine_dosage_id')->constrained('vaccine_dosages')->cascadeOnDelete();
            $table->date('vaccination_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccines');
    }
};
