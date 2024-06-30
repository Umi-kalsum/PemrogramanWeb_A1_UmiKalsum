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
        Schema::create('order_menus', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer("menu_id");
            $table->integer("order_id");
            $table->integer("menu_price");
            $table->integer("quantity");
            $table->string("note")->nullable();
            $table->unique(["menu_id","order_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_menus');
    }
};
