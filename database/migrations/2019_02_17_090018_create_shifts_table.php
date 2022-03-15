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
            $table->date('date')->nullable();
            $table->integer('period')->default(1);
            $table->integer('pos')->default(1);
            $table->timestamps();
            $table->integer('employee_id')->nullable();
            $table->decimal('value');
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
