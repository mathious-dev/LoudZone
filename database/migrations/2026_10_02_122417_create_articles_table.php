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
            $table->text('description')->nullable();  
            $table->decimal('price_ht', 5, 2);   
            $table->string('slug')->unique();   
            $table->integer('stock')->default(0);   
            $table->boolean('is_published')->default(false);   
            $table->decimal('tva', 5, 2)->default(21.00);
            $table->string('primary_image')->nullable();
            $table->decimal('final_price');
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
