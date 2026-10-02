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
       // Table articles
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('user_id_creator')->constrained('users');
            $table->foreignId('user_id_buyer')->nullable()->constrained('users');
            $table->foreignId('article_category_id')->nullable()->constrained();
        });

        // Table add_info_by_categories
        Schema::table('add_info_by_categories', function (Blueprint $table) {
            $table->foreignId('add_info_id')->constrained();
            $table->foreignId('category_message_support_id')->constrained();
        });

        // Table support_messages
        Schema::table('support_messages', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('add_info_id')->nullable()->constrained();
            $table->foreignId('category_message_support_id')->constrained();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id_creator');
            $table->dropConstrainedForeignId('user_id_buyer');
            $table->dropConstrainedForeignId('category_id');
        });
    }
};
