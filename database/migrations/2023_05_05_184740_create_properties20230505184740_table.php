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
        Schema::create('properties20230505184740s', function (Blueprint $table) {
            $table->id();
			$table->text('title');
			$table->text('reference');
			$table->float('price');
			$table->boolean('show_price');
			$table->boolean('show_address');
			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties20230505184740');
    }
};
