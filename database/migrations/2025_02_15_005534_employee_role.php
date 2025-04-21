<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeeRole extends Migration
{
    public function up()
    {
        Schema::create('employee_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_role', 100)->unique(); // Límite razonable para nombres de roles
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('employee_roles');
    }
}
