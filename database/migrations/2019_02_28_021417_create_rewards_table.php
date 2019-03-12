<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('isDeduct')->default(false);
            $table->unsignedInteger('employee');
            $table->string('title');
            $table->text('description')->nullable()->default(NULL);
            $table->integer('amount');
            $table->date('date');
            $table->timestamps();
            
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
        Schema::dropIfExists('rewards');
    }
}
