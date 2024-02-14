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
        Schema::create('Transaction_Detail', function (Blueprint $table) {
            $table->id();
            $table->string('Document_Code', 3);
            $table->string('Document_Number', 10);
            $table->string('Product_Code', 18);
            $table->float('Price', 6, 0);
            $table->integer('Quantity');
            $table->string('Unit', 5);
            $table->float('Sub_Total', 10, 0);
            $table->string('Currency', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_detail');
    }
};
