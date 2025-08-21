<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientXraysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_xrays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('xray_id');
            $table->unsignedBigInteger('appointment_id');
            $table->date('xray_date')->useCurrent();
            $table->integer('qty')->default(1);
            $table->decimal('total_cost', 10, 0);
            $table->unsignedBigInteger('user_id');
            $table->date('discharge_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_xrays');
    }
}
