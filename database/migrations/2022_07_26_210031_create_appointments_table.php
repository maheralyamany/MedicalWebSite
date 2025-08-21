<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('status_id')->default(0);
            $table->unsignedBigInteger('service_id');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->decimal('price', 10, 0);
            
            $table->foreign('doctor_id', 'appointments_doctor_id_foreign')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('patient_id', 'appointments_patient_id_foreign')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
