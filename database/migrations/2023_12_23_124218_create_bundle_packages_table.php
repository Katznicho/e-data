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
        Schema::create('bundle_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('duration'); // Daily, Weekly, Monthly, etc.
            $table->foreignId('validity_id')->nullable()->references('id')->on('validities')->onDelete('set null'); 
            $table->decimal('data_amount', 10, 2)->nullable(); // Use decimal for precise storage
            $table->unsignedInteger('minutes')->default(0);
            $table->unsignedInteger('sms')->default(0);
            $table->unsignedInteger('price');
            $table->decimal('discount', 5, 2)->default(0); // Percentage discount
            $table->unsignedBigInteger('network_provider_id');
            $table->timestamps();

            // Foreign key constraint for network_provider_id
            $table->foreign('network_provider_id')->references('id')->on('network_providers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bundle_packages');
    }
};
