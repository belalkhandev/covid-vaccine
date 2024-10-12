<?php

use App\Enums\VaccineStatus;
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
        Schema::create('vaccine_recipients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nid', 20)->unique()->index();
            $table->string('email');
            $table->string('contact_no', 20);
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->foreignId('vaccine_center_id')->nullable()->constrained('vaccine_centers')->nullOnDelete();
            $table->enum('status', VaccineStatus::values())->default(VaccineStatus::REGISTERED->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccine_recipients');
    }
};
