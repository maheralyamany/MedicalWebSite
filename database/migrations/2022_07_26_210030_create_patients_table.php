<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patientname', 50);
            $table->string('mobile', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->unsignedBigInteger('city_id')->default(0);
            $table->text('address');
            $table->integer('age')->default(0);
            $table->text('photo')->nullable();
            $table->string('bloodgroup', 20)->default('O+');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
