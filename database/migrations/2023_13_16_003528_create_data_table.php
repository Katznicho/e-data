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
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string("description")->nullable();
            $table->string("total_amount")->nullable();
            $table->json("phone_number")->nullable();
            $table->json("network_providers")->nullable();
            $table->json("bundle_packages")->nullable();
            $table->softDeletes();
            $table->foreignId("user_id")->nullable()->references("id")->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
