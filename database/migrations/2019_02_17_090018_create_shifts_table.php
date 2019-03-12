<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table')->default(1);
            $table->year('year');
            $table->integer('week');
            $table->integer('day');
            $table->date('date');
            $table->unsignedInteger('period')->default(1);
            $table->unsignedInteger('pos')->default(1);
            $table->timestamps();
            $table->unsignedInteger('employee')->nullable();
            $table->decimal('value');
            
            $table->foreign('employee')->references('id')->on('employees');
            $table->index('employee'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
}
