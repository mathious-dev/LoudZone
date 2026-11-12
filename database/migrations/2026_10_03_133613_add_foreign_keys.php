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
            $table->foreignUlid('user_id')->nullable()->constrained()->nullOnDelete()->change();
            $table->foreignUlid('category_id')->nullable()->constrained()->nullOnDelete()->change();
            $table->foreignUlid('promotion_id')->nullable()->constrained()->nullOnDelete()->change();
        });

        // Table add_info_by_categories
        Schema::table('add_info_by_categories', function (Blueprint $table) {
            //le references et le on veut dire : cette colonne doit correspondre à un ID qui existe déjà dans la table qui est dans le on
            $table->foreign('add_info_id')->references('id')->on('add_infos')->cascadeOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
        });

        // Table support_messages
        Schema::table('support_messages', function (Blueprint $table) {
            $table->foreignUlid('user_id')->nullable()->constrained()->nullOnDelete()->change();
            $table->foreignUlid('add_info_id')->nullable()->constrained()->change();
            $table->foreignUlid('category_id')->nullable()->constrained()->nullOnDelete()->change();
        });

        // Table orders
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignUlid('user_id')->nullable()->constrained()->nullOnDelete()->change();
        });

        // Table article_orders
        Schema::table('article_orders', function (Blueprint $table) {
            $table->foreignUlid('article_id')->nullable()->constrained()->nullOnDelete()->change();
            $table->foreignUlid('order_id')->constrained()->cascadeOnDelete();
        });

        // Table payment
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignUlid('order_id')->constrained()->cascadeOnDelete();
        });

        // Table event
        Schema::table('events', function(Blueprint $table) {
            $table->foreignUlid('address_id')->nullable()->constrained()->nullOnDelete()->change();
        });

        // Table carts
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignUlid('user_id')->nullable()->constrained()->nullOnDelete()->change();
        });

        // Table cart_items
        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreignUlid('article_id')->constrained()->cascadeOnDelete()->change();
            $table->foreignUlid('cart_id')->constrained()->cascadeOnDelete()->change();
        });

        // Table clothes
        Schema::table('clothes', function (Blueprint $table) {
            $table->foreignUlid('article_id')->constrained()->cascadeOnDelete()->change();
        });

        // Table announcements
        Schema::table('announcements', function (Blueprint $table) {
            $table->foreignUlid('category_id')->nullable()->constrained()->nullOnDelete()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // La méthode dropConstrainedForeignId fonctionne aussi bien pour
        // les IDs classiques que pour les ULIDs car elle se base sur le nom de la colonne.

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
            $table->dropConstrainedForeignId('category_id');
            $table->dropConstrainedForeignId('add_info_id');
            $table->dropConstrainedForeignId('user_id');
        });

        // Table add_info_by_categories
        Schema::table('add_info_by_categories', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->dropConstrainedForeignId('add_info_id');
        });

        // Table articles
        Schema::table('articles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
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

        // Table announcements
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
        });
    }
};
