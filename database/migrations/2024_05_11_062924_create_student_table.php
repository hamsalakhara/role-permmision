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
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email_id')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('standard')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // Using ENUM for gender
            $table->year('entry_year')->nullable(); // Using YEAR data type for entry_year
            $table->softDeletes(); // Using softDeletes method
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
