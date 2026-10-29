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
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->change();
            $table->foreignId('article_category_id')->nullable()->constrained()->nullOnDelete()->change();
            //le ->restrictOnDelete() va nous permettre d'empêcher la suppression si un aticle utilise toujours la promotion
            $table->foreignId('promotion_id')->nullable()->constrained()->restrictOnDelete()->change();
        });

        // Table add_info_by_categories (Ici ce sont des cascades, donc pas de nullable, c'est bon)
        Schema::table('add_info_by_categories', function (Blueprint $table) {
            $table->foreignId('add_info_id')->constrained()->cascadeOnDelete();
            $table->foreignId('support_message_category_id')->constrained()->cascadeOnDelete();
        });

        // Table support_messages
        Schema::table('support_messages', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->change();
            $table->foreignId('add_info_id')->nullable()->constrained()->change();
            $table->foreignId('support_message_category_id')->constrained();
        });

        // Table orders
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->change();
        });

        // Table article_orders
        Schema::table('article_orders', function (Blueprint $table) {
            $table->foreignId('article_id')->nullable()->constrained()->nullOnDelete()->change();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
        });

        // Table payment
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
        });

        // Table event
        Schema::table('events', function(Blueprint $table) {
            $table->foreignId('address_id')->nullable()->constrained()->nullOnDelete()->change();
        });
        
        // Table carts
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->change();
        });

        // Table cart_items
        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained()->cascadeOnDelete()->change();
            $table->foreignId('cart_id')->constrained()->cascadeOnDelete()->change();
        });

        // Table clothes
        Schema::table('clothes', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained()->cascadeOnDelete()->change();
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

        // Table carts
        Schema::table('carts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });

        // Table cart_items
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('article_id');
            $table->dropConstrainedForeignId('cart_id');
        });

        // Table clothes
        Schema::table('clothes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('article_id');
        });
    }
};