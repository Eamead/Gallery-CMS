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
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['photo', 'pdf', 'link']);
            $table->unsignedInteger('user_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamp('upload_date')->useCurrent();
            $table->date('estimated_date')->nullable();
            $table->string('estimated_location', 255)->nullable();
            $table->enum('privacy_setting', ['public', 'private'])->default('public');
            $table->unsignedInteger('gallery_id')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->text('additional_info')->nullable();
            $table->string('copyright_info', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');

            // Indexes
            $table->index('user_id');
            $table->index('gallery_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
