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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
//            $table->longText('image')->nullable();
            $table->longText('content')->nullable();
            $table->text('summary')->nullable();
            $table->integer('min_read')->nullable();
            $table->string('short_link')->nullable();
            $table->enum('status' , \App\Models\Front\News::$status)
                ->default(\App\Models\Front\News::STATUS_PENDING);
            $table->foreignId('reporter_id')->constrained('users')->cascadeOnUpdate();// خبرنگار
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
