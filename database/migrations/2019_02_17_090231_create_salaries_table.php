<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->year('year');
            $table->integer('month');
            $table->unsignedInteger('employee');
            $table->decimal('constantSalary')->default(0);
            $table->decimal('totalShifts')->default(0);
            $table->decimal('totalRewards')->default(0);
            $table->decimal('totalDeducts')->default(0);
            $table->decimal('total')->default(0);
            $table->boolean('isRecieved')->default(false);
            $table->timestamp('dueDate')->nullable()->default(null);
            $table->timestamp('recieveDate')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('employee')->references('id')->on('employees');
            $table->index('employee'); 
            $table->unique(['year', 'month', 'employee']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries');
    }
}
