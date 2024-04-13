<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('material_id')->nullable();
            $table->bigInteger('uom')->nullable();
            $table->string('name')->nullable();
            $table->decimal('unit_count')->nullable();
            $table->decimal('cost')->nullable();
            $table->decimal('projected_price')->nullable();
            $table->decimal('min_qty')->nullable();
            $table->text('remark')->nullable();
            $table->bigInteger('image')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('vendor_data');
    }
};
