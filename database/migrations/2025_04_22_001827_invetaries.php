<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Invetaries extends Migration
{
    public function up()
    {
        Schema::create('moviments_in', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name_client')->nullable();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->date('date_in');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('moviments_out', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name_client')->nullable();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->date('date_out');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('products_moviments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_moviment_in')->nullable()->constrained('moviments_in')->onDelete('cascade');
            $table->foreignId('id_moviment_out')->nullable()->constrained('moviments_out')->onDelete('cascade');
            $table->foreignId('id_product')->constrained('products')->onDelete('cascade');
            $table->decimal('amount_kg', 10, 2);
            $table->unsignedBigInteger('price_product');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products_moviments');
        Schema::dropIfExists('moviments_out');
        Schema::dropIfExists('moviments_in');
    }
}
