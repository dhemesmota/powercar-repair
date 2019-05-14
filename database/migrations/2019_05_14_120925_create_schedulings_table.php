<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedulings', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->time('hour');
            $table->integer('user_id')->unsigned(); // chave estrangeira
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('situation_id')->unsigned(); // chave estrangeira
            $table->foreign('situation_id')->references('id')->on('situations')->onDelete('cascade');
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
        Schema::dropIfExists('schedulings');
    }
}
