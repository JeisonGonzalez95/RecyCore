<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Employee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname', 150); // Suficiente para nombres completos
            $table->unsignedBigInteger('dni')->unique(); // Como en `users_app`, DNI como unsigned
            $table->string('email', 150); // Límite razonable para MySQL
            $table->string('phone', 20); // Como string para evitar problemas con ceros y signos
            $table->foreignId('rol_id')->nullable()->constrained('employee_roles'); // Bien
            $table->foreignId('area_id')->nullable()->constrained('employee_areas'); // Bien
            $table->tinyInteger('state')->default(1); // Para estados simples
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
        Schema::dropIfExists('employees');
    }
}
