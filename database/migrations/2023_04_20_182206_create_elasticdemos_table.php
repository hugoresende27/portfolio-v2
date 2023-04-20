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
        Schema::create('elasticdemos', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('street')->nullable();
            $table->text('number')->nullable();
            $table->text('code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elasticdemos');
    }
};
