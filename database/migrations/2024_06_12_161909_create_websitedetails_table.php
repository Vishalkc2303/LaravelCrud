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
        Schema::create('websitedetails', function (Blueprint $table) {
            $table->id();
            $table->string('website_name');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('email');
            $table->string('phone_no');
            $table->string('location');
            $table->year('year');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('websitedetails');
    }
};
