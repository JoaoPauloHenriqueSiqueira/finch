<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowsTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flows_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('flows_id')->unsigned();
            $table->integer('tasks_id')->unsigned();
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::table('flows_tasks', function ($table) {
            $table->foreign('flows_id')->references('id')->on('flows')->onDelete('cascade');
            $table->foreign('tasks_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flow_task');
    }
}
