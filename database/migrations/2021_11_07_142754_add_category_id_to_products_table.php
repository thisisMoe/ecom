<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('main_category_id')->nullable()->constrained('main_categories')->after('link');
            $table->foreignId('category_id')->nullable()->constrained('categories')->after('main_category_id');
            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories')->after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_main_category_id_foreign');
            $table->dropForeign('products_category_id_foreign');
            $table->dropForeign('products_sub_category_id_foreign');
        });
    }
}
