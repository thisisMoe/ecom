<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->integer('totalSum');
            $table->integer('fee');
            $table->float('usdP');
            $table->integer('shippingCost');
            $table->string('shippingTime');
            $table->text('selectedProps');
            $table->text('uri');
            $table->string('productId');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('shopping_session_id')->constrained('shopping_sessions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
