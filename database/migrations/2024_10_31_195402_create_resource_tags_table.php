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
        Schema::create('resource_tags', function (Blueprint $table) {
            $table->unsignedInteger('resource_id');
            $table->unsignedInteger('tag_id');

            // Primary Key
            $table->primary(['resource_id', 'tag_id']);

            // Foreign Keys
            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            // Indexes
            $table->index('tag_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_tags');
    }
};
