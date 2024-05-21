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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cnpj', 14)->unique();
            $table->string('address');
            $table->string('phone', 15);
            $table->string('email')->unique();
            $table->date('foundation_date')->nullable();
            $table->string('industry')->nullable();
            $table->enum('size', ['small', 'medium', 'large'])->nullable();
            $table->string('legal_representative_name')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('website')->nullable();
            $table->integer('number_of_employees')->nullable();
            $table->string('state_registration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
