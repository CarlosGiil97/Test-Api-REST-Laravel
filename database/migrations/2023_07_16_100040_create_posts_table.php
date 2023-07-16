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
            $table->foreignId('id_cat')->constrained('categories');
            $table->foreignId('id_user')->constrained('users');
            $table->text('title');
            $table->text('body');
            $table->text('images');
            $table->timestamp('date_created')->useCurrent();
            $table->timestamp('date_modified')->nullable();
            $table->boolean('is_edited')->default(false);
            $table->integer('num_likes')->default(0);
            $table->integer('num_comments')->default(0);
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
