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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable()->unique();
            $table->string('title_en');
            $table->string('slug_en');
            $table->longText('body')->nullable();
            $table->enum('status' , \App\Models\Manager\Product::$statuses)
                    ->default(\App\Models\Manager\Product::STATUS_PENDING);
            $table->decimal('price' , 3);

            $table->tinyInteger('sold_number')->default(0)
                ->nullable()
                ->comment('کاربر انتخاب کرده و پرداخت انجام شده ');

            $table->tinyInteger('frozen_number')->default(0)
                ->nullable()
                ->comment('کاربر از سبد خرید انتخاب کرده در مرحله پرداخت هست ');

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
