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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            // Personal Information
            $table->string('identity_number', 16)->unique(); // (NIK)
            $table->string('medical_record_number', 16)->unique(); // (No. Rekam Medis)
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->enum('gender', ['P', 'L']); // (Laki-laki, Perempuan)
            $table->string('phone_number', 15);
            $table->string('email');
            $table->string('address');

            // Medical Information
            $table->string('blood_type', 10); // (Golongan Darah)
            $table->string('allergies')->nullable(); // (Alergi)
            $table->string('current_medicines')->nullable(); // (Obat yang Sedang Dikonsumsi)
            $table->text('medical_history')->nullable(); // (Riwayat Penyakit)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
