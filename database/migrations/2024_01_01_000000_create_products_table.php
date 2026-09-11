<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category'); // cleansers, serums, moisturizers, makeup
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->decimal('compare_price', 8, 2)->nullable();
            $table->string('image')->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
