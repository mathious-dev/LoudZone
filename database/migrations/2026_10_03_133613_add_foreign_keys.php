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
       //Table articles
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('article_category_id')->nullable()->constrained()->nullOnDelete();
        });

        // Table add_info_by_categories
        Schema::table('add_info_by_categories', function (Blueprint $table) {
            $table->foreignId('add_info_id')->constrained()->cascadeOnDelete();
            $table->foreignId('support_message_category_id')->constrained()->cascadeOnDelete();
        });

        // Table support_messages
        Schema::table('support_messages', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('add_info_id')->nullable()->constrained();
            $table->foreignId('support_message_category_id')->constrained();
        });

        //Table orders
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        });

        //Table article_orders
        Schema::table('article_orders', function (Blueprint $table) {
            $table->foreignId('article_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
        });

        //Table payment
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
        });

        //Table événement
       Schema::table('events', function(Blueprint $table) {
            $table->foreignId('address_id')->nullable()->constrained()->nullOnDelete();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Table payment
        Schema::table('payments', function (Blueprint $table) {
            $table->dropConstrainedForeignId('order_id');
        });

        // Table article_orders
        Schema::table('article_orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('order_id');
            $table->dropConstrainedForeignId('article_id');
        });

        // Table orders
        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });

        // Table support_messages
        Schema::table('support_messages', function (Blueprint $table) {
            $table->dropConstrainedForeignId('support_message_category_id');
            $table->dropConstrainedForeignId('add_info_id');
            $table->dropConstrainedForeignId('user_id');
        });

        // Table add_info_by_categories
        Schema::table('add_info_by_categories', function (Blueprint $table) {
            $table->dropConstrainedForeignId('support_message_category_id');
            $table->dropConstrainedForeignId('add_info_id');
        });

        // Table articles
        Schema::table('articles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('article_category_id');
            $table->dropConstrainedForeignId('user_id');
        });

        //Table événement
        Schema::table('events',function(Blueprint $table) {
            $table->dropConstrainedForeignId('address_id');
        });
    }
};