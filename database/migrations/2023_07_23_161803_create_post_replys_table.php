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
        Schema::create('post_replys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_post');
            $table->foreign('id')->references('id_post')->on('posts')->onDelete('cascade');
            $table->text('title');
            $table->text('body');
            $table->timestamp('date_created')->useCurrent();
            $table->timestamp('date_modified')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_replys');
    }
};
