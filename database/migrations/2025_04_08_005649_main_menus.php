<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MainMenus extends Migration
{

    public function up()
    {
        Schema::create('main_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_menu', 100)->unique(); // Limitar longitud por eficiencia
            $table->string('slug_menu', 100)->unique();
            $table->tinyInteger('state')->default(1); // Ideal para estado binario
            $table->timestamps();
        });
        
        Schema::create('menu_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_item', 100);
            $table->string('route_item', 150); // Puede ser una ruta tipo "admin/usuarios"
            $table->foreignId('main_menu_id')
                  ->constrained('main_menus')
                  ->onDelete('cascade');
            $table->tinyInteger('state')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('main_menus');
        Schema::dropIfExists('menu_items');
    }
}
