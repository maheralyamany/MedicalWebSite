<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('mobile', 100)->unique('users_mobile_unique');
            $table->string('email', 100)->nullable();
            $table->string('password');
            $table->enum('status', ['0', '1'])->default('1');
            $table->unsignedBigInteger('branch_id')->default(1);
            $table->unsignedBigInteger('group_id')->default(1);
            $table->text('id_card')->nullable();
            $table->unsignedBigInteger('card_type_id')->default(0);
            $table->string('birth_date', 100)->nullable();
            $table->text('address')->nullable();
            $table->text('photo')->nullable();
            
            $table->foreign('group_id', 'users_group_id_foreign')->references('id')->on('user_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
