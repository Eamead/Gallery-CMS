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
        Schema::create('resource_categories', function (Blueprint $table) {
            $table->unsignedInteger('resource_id');
            $table->unsignedInteger('category_id');

            // Primary Key
            $table->primary(['resource_id', 'category_id']);

            // Foreign Keys
            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            // Indexes
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_categories');
    }
};
