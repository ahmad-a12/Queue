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
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('city');
            $table->string('address');
            $table->decimal('salary',8,2);
            $table->integer('phone_number')->unique();
            $table->date('hiredate');
            $table->date('birthdate')->nullable();
            $table->foreignUuId('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreignUuId('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreignUuId('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
