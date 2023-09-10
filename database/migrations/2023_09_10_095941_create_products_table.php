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
        $statusValues = ['ACTIVE', 'INACTIVE', 'DELETED'];

        Schema::create('products', function (Blueprint $table) use ($statusValues) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('description', 255)->default('N/A');
            $table->string('category', 50);
            $table->enum('status', $statusValues);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
