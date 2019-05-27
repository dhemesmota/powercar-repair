<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->decimal('total_price', 8, 2)->nullable();
            $table->integer('situation_id')->unsigned(); // chave estrangeira
            $table->foreign('situation_id')->references('id')->on('situations')->onDelete('cascade');
            $table->integer('client_id')->unsigned(); // chave estrangeira
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('vehicle_id')->unsigned()->nullable(); // chave estrangeira
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->integer('employee_id')->unsigned(); // chave estrangeira
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('budgets');
    }
}
