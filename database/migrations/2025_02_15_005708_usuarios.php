<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_app', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname', 100);
            $table->unsignedBigInteger('dni')->unique();
            $table->string('email', 150);
            $table->string('username', 150)->unique();
            $table->string('password', 255);
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('cascade');
            $table->tinyInteger('state')->default(1);
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
        Schema::dropIfExists('users_app');
    }
}
