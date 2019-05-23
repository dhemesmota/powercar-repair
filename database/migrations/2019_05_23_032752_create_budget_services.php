<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_services', function (Blueprint $table) {
            $table->integer('budget_id')->unsigned(); // unsigned indica que seram apenas numeros positivos
            $table->integer('service_id')->unsigned();
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budget_services', function (Blueprint $table) {
            $table->dropForeign('budget_services_budget_id_foreign');
            $table->dropForeign('budget_services_service_id_foreign');
        });
        Schema::dropIfExists('budget_services');
    }
}
