<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeeArea extends Migration
{

    public function up()
    {
        Schema::create('employee_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_area', 100)->unique(); // Limitar longitud para mejor índice
            $table->timestamps();
        });        
    }

    public function down()
    {
        Schema::dropIfExists('employee_areas');
    }
}
