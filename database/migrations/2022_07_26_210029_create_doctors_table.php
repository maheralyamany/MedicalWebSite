<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('nickname_id')->default(0);
            $table->unsignedBigInteger('specification_id')->default(0);
            $table->unsignedBigInteger('nationality_id')->default(0);
            $table->double('consulting_price', 10, 2)->unsigned()->default(0.00);
            $table->double('salary', 10, 2)->unsigned()->default(0.00);
            
            $table->foreign('user_id', 'doctors_user_id_foreign')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
