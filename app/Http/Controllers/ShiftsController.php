<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Shift;
use App\Table;
use Illuminate\Http\Request;

class ShiftsController extends Controller
{
    
	// views

	public function show($table = 1, $year = "current", $weeknum = "current")
	{
		// TODO : FIND OR FAIL TABLE NAME FROM TABLE OPJECT

		$table = Table::findOrFail($table);
		// Get Current
		if ($weeknum == "current") 	$weeknum = $this->current_week();
		if ($year == "current") 	$year = date("Y");

		// Get Shifts+Employees
		$shifts = $this->get_week($table->id,$year,$weeknum);
		$employees = Employee::where('isCashier',true)->get();
		return view("shifts.week-view",compact('shifts','employees','weeknum','year','table'));
	}

	public function edit($table,$year = "current", $weeknum = "current")
	{
		if ($weeknum == "current") $weeknum = $this->current_week();
		if ($year == "current") $year = date("Y");
		$table = Table::findOrFail($table);
		// Get Shifts+Employees
		$shifts = $this->get_week($table->id,$year,$weeknum);
		$employees = Employee::where('isCashier',true)->get();
		return view("shifts.week-edit",compact('shifts','employees','weeknum','year','table'));
	}

	public static function create($table, $year = NULL, $weeknum = NULL, $fromyear = NULL, $fromweeknum = NULL)
	{
		# Default Values
			# Get Next of latest week number
			$table = Table::findOrFail($table);
			if ($weeknum == NULL) 					$weeknum = Shift::where('table',$table->id)->max('week')+1;
			// if ($weeknum < $this->current_week()) 	$weeknum = $this->current_week();
			if ($year == NULL) 						$year = date("Y");
			if ($fromweeknum == NULL)	if ( !is_null(Shift::where('table',$table->id)->max('week')) )		$fromweeknum = Shift::where('table',$table->id)->max('week');
			if ($fromyear == NULL)					$fromyear = date("Y");
		# Week settings
			$days = 7; 						// TODO: TO BE CHANGED TO DEFAULT VALUE SETTING
			$periods = $table->periods; 	
			$poss = $table->slots; 			



		# WEEK DATES COUNTER 
			$week_start = new \DateTime();
			$week_start->setISODate($year,$weeknum);
			$week_start = $week_start->modify('-1 day');

			$date[1] = $week_start->format('Y-m-d');
			$date[2] = $week_start->modify('+1 day')->format('Y-m-d');
			$date[3] = $week_start->modify('+1 day')->format('Y-m-d');
			$date[4] = $week_start->modify('+1 day')->format('Y-m-d');
			$date[5] = $week_start->modify('+1 day')->format('Y-m-d');
			$date[6] = $week_start->modify('+1 day')->format('Y-m-d');
			$date[7] = $week_start->modify('+1 day')->format('Y-m-d');

		if ( is_null(Shift::where("table",$table->id)->where("year",$fromyear)->where("week",$fromweeknum)->first()) )
			$create_default_values = true;
		else 
			$create_default_values = false;



		if ( !is_null(Shift::where("table",$table->id)->where("year",$year)->where("week",$weeknum)->first()) ) {

			return redirect('/shifts/'.$table->id.'/'.$year.'/'.$weeknum)->with('msgs',[['warning' => 'هذا الأسبوع موجود مسبقاً ، لإعادة إنشاءه قم بحذفه أولاً.']]);
		}



			if (!$create_default_values) {
			
					$inhert_shifts = Shift::
						where("table",$table->id)
						->where("year",$fromyear)
						->where("week",$fromweeknum)
						->get();
				foreach ($inhert_shifts as $inhert_shift) {
					$shift = new Shift;
					$shift->table = $table->id;
			  	  	$shift->year = $year;
			  	  	$shift->week = $weeknum;
			  	  	$shift->day = $inhert_shift->day;
			  	  	$shift->date = $date[$inhert_shift->day];
			  	  	$shift->period = $inhert_shift->period;
			  	  	$shift->pos = $inhert_shift->pos;
					$shift->employee_id = $inhert_shift->employee_id;
			  		$shift->value = $inhert_shift->value; 
			  		 
			  	  	$shift->save();
			  	}

			} else {


					for ($day=1; $day <= $days ; $day++) { 
					 for ($period=1; $period <= $periods; $period++) { 
					  for ($pos=1; $pos <= $poss ; $pos++) {

					  	try{
					  		
							  	$shift = new Shift;
							  	$shift->table = $table->id;
							  	$shift->year = $year;
							  	$shift->week = $weeknum;
							  	$shift->day = $day;
							  	$shift->date = $date[$day];
							  	$shift->period = $period;
							  	$shift->pos = $pos;
								$shift->employee_id = NULL; 
								$shift->value = 75; 

							  	$shift->save();
						}
						catch(\Exception $e) {
					  	    report($e->getMessage());   // insert query
					  	}

					  }
					 }
					}
			}







		return redirect('/shifts/'.$table->id.'/'.$year.'/'.$weeknum);
	}


	public function update()
	{
		$shifts = array();
		foreach (request()->all() as $key => $value) {
			$field = explode( "-",$key );
			if(count($field) < 2) continue;
			if ($value == "none") $value = NULL;
			$shifts[$field[1]][$field[0]] = $value;
					}
		$table = request('table');
		$year = request('year');
		$weeknum = request('weeknum');
					$employees = [];
		foreach ($shifts as $id => $new) {
			$shift = Shift::find($id);
			$shift->value = $new['value'];
			$employee = Employee::find($new['employee']);
			$shift->employee_id = $employee ? $employee->id : NULL;
			$shift->save();
		}
		// dd([$shifts_]);
		return redirect("/shifts/".$table."/".$year."/".$weeknum);
	}


	// HELPERS

	public function current_week()
	{
		return date("W",strtotime(date("w")==0?"+7 day":"+0 day"));
	}

	public function get_week($table,$year = "current",$weeknum = "current")
	{
		if ($weeknum == "current") {
			$weeknum = $this->current_week();
		}
		if ($year == "current") {
			$year = date("Y");
		}
		$table = Table::findOrFail($table);
		$weeknum = (int)$weeknum;
		$year = (int)$year;
		
		return Shift::orderBy("day")->orderBy("period")->orderBy("pos")->get()->where('table',$table->id)->where('week',$weeknum)->where('year',$year);
	}

	// public function isset_week($weeknum)
	// {
	// 	if ($weeknum == NULL) {
	// 		$weeknum = Shift::max('week')+1;
	// 	}
	// 	return date("W",strtotime(date("w")==0?"+7 day":"+0 day"));
	// }
	


}
