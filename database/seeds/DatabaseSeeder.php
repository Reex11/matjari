<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(ShiftsTableSeeder::class);
        $current_week = date("W",strtotime(date("w")==0?"+7 day":"+0 day"));
        \App\Http\Controllers\ShiftsController::create_week(date('y'),$current_week);
    }
}
