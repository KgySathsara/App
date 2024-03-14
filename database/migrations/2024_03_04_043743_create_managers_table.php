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
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->string('Manager Name');
            $table->string('Manager Email Address')->unique();
            $table->string('Manager Phone Number');
            $table->foreignId('Branch_id')->constrained('branches')->onDelete('cascade');
            $table->timestamps();
            $table->unique('Branch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managers');
    }
};
