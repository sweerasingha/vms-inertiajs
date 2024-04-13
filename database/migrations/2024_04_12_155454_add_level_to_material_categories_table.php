<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLevelToMaterialCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('material_categories', function (Blueprint $table) {
            $table->integer('level')->default(0);  // Assuming 'level' is an integer
        });
    }

    public function down()
    {
        Schema::table('material_categories', function (Blueprint $table) {
            $table->dropColumn('level');
        });
    }
}
