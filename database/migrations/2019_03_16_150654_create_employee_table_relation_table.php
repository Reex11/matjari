<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTableRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_table', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('table');
            $table->unsignedInteger('employee');
            $table->timestamps();

            $table->foreign('employee')->references('id')->on('employees');
            $table->foreign('table')->references('id')->on('tables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_table');
    }
}
