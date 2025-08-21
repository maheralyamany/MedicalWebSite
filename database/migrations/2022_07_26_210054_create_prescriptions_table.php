<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id');
            $table->date('start_date')->nullable();
            $table->unsignedBigInteger('drug_id');
            $table->string('dosage');
            $table->integer('quantity')->default(1);
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('take_way_id');
            $table->unsignedBigInteger('interval_id');
            $table->decimal('unit_size', 10, 0)->default(1);
            $table->text('note')->nullable();
            $table->enum('status', ['0', '1'])->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescriptions');
    }
}
