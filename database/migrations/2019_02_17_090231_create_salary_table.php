<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->increments('id');
            $table->year('year');
            $table->integer('month');
            $table->unsignedInteger('employee');
            $table->decimal('constantSalary');
            $table->decimal('shiftsValue');
            $table->decimal('bounces');
            $table->decimal('discounts');
            $table->decimal('total');
            $table->boolean('isRecieved');
            $table->timestamp('dueDate')->nullable()->default(null);
            $table->timestamp('recieveDate')->nullable()->default(null);
            $table->foreign('employee')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary');
    }
}
