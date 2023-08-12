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

        Schema::create('roles', function (Blueprint $table) use ($statusValues) {
            $table->increments('id');
            $table->string('name');
            $table->enum('status', $statusValues);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) use ($statusValues) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->enum('status', $statusValues);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_roles', function (Blueprint $table) use ($statusValues) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');
            $table->enum('status', $statusValues);
            $table->timestamps();

            $table->primary(['user_id', 'role_id']);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
};
