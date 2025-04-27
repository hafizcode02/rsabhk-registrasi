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
        Schema::create('patien_registrations', function (Blueprint $table) {
            $table->id();
            $table->date('registration_date');
            $table->string('insurance_number', 20)->unique(); // (No. Asuransi)
            $table->string('responsible_person_name');
            $table->string('responsible_person_phone', 15);
            $table->string('responsible_email');
            $table->string('responsible_person_relationship'); // (Hubungan dengan Pasien)
            $table->string('responsible_person_address');

            // Foreign keys
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('insurance_id')->constrained('insurances')->onDelete('cascade');
            $table->foreignId('service_room_id')->constrained('service_rooms')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patien_registrations');
    }
};
