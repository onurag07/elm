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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('role')->default('user');
            $table->string('email',100)->unique();
            $table->string('password');
            $table->boolean('status')->nullable();
            $table->bigInteger('phone');
            $table->text('address');
            $table->string('gender');
            $table->date('dob');
            $table->date('doj');
            $table->bigInteger('leaves_count')->default(25);
            $table->bigInteger('leaves_balance')->default(25);
            $table->rememberToken();
            $table->timestamps();
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
