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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');;

            $table->foreignId('category_id')
                ->nullable()
                ->constrained(table: 'categories', indexName: 'posts_category_id')
                ->onDelete('set null');

            $table->string('cover_image')->nullable();
            $table->string('unsplash_image_url')->nullable();

            $table->string('slug')->unique();
            $table->text('body');
            $table->text('published_at')->nullable();
            $table->enum('visibility', ['public', 'private'])->default('public');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};