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

    Schema::create('locations', function (Blueprint $table) use ($statusValues) {
      $table->id();
      $table->string('name', 100)->unique();
      $table->enum('status', $statusValues);
      $table->timestamps();
    });

    Schema::create('location_product_stock', function (Blueprint $table) {
      $table->unsignedBigInteger('location_id');
      $table->unsignedBigInteger('product_id');
      $table->unsignedDecimal('quantity');
      $table->timestamps();

      $table->primary(['location_id', 'product_id']);

      $table->foreign('location_id')->references('id')->on('locations');
      $table->foreign('product_id')->references('id')->on('products');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('location_product_stock');
    Schema::dropIfExists('locations');
  }
};
