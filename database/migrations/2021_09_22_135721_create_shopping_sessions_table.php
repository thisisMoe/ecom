<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('total')->default(0);
            $table->string('trackingNumber')->default('');
            $table->integer('totalFee')->default(0);
            $table->integer('totalShipping')->default(0);
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->enum('orderStatus', ['pending', 'confirmed', 'shipped', 'delivered'])->default('pending');
            $table->boolean('withPayment')->nullable()->default(false);
            $table->boolean('seen')->default(false);
            $table->string('proofImage')->nullable()->default('');
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
        Schema::dropIfExists('shopping_sessions');
    }
}
