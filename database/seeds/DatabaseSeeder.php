<?php

use App\Http\Controllers\ShiftsController;
use App\Shift;
use App\Table;
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
        $default_table = Table::firstOrCreate(
            ['name'=>"Default"],
            [
                'periods'=>'3',
                'slots'=>'2'
            ]
        );
        $current_week = date("W",strtotime(date("w")==0?"+7 day":"+0 day"));
        ShiftsController::create($default_table,date('y'),$current_week);
    }
}
