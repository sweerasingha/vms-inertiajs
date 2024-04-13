<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendor_taxes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_id')->nullable();
            $table->string('tax_name')->nullable();
            $table->string('tax_type')->nullable();
            $table->decimal('value', 15, 2)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_taxes');
    }
};
