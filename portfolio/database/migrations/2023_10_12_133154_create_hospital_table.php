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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id('hospital_id');
            $table->text('hospital_name');
            $table->text('hospital_phone_number')->nullable();
            $table->text('hospital_address')->nullable();
            $table->dateTime('previous_attend', $precision = 0)->nullable();
            $table->dateTime('next_attend', $precision = 0)->nullable();
            $table->foreignId('department_id')->constrained('departments', 'department_id');
            $table->foreignId('id')->constrained('users', 'id');
            $table->foreignId('previous_treatment_id')->constrained('treatments', 'treatment_id')->default('1');
            $table->foreignId('next_treatment_id')->constrained('treatments', 'treatment_id')->default('1');
            $table->text('flag_delete')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
