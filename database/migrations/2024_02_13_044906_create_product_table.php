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
        Schema::create('Product', function (Blueprint $table) {
            $table->id();
            $table->string('Product_Code', 18);
            $table->string('Product_Name', 30);
            $table->float('Price', 6, 0);
            $table->string('Currency', 5);
            $table->float('Discount', 6, 0);
            $table->string('Dimension', 50);
            $table->string('Unit', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
