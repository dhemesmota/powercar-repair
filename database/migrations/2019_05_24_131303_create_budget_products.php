<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_products', function (Blueprint $table) {
            $table->integer('budget_id')->unsigned(); // unsigned indica que seram apenas numeros positivos
            $table->integer('product_id')->unsigned();
            $table->integer('amount');
            $table->decimal('value', 8, 2);
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budget_products', function (Blueprint $table) {
            $table->dropForeign('budget_products_budget_id_foreign');
            $table->dropForeign('budget_products_product_id_foreign');
        });
        Schema::dropIfExists('budget_products');
    }
}
