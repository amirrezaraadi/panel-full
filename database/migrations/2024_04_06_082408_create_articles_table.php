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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
//            $table->longText('image')->nullable();
            $table->longText('content')->nullable();
            $table->text('summary')->nullable();
            $table->integer('min_read')->nullable();
            $table->string('short_link')->nullable();
            $table->enum('status' , \App\Models\Manager\Article::$status)
                ->default(\App\Models\Manager\Article::STATUS_PENDING);
            $table->foreignId('author_id')->constrained('users')->cascadeOnUpdate();// نویسنده
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
