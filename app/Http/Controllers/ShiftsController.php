<?php

namespace App\Http\Controllers;

use App\Shift;

class ShiftsController extends Controller
{
    
	public function day($num="all")
	{

		$days = array ( 
					1 => "الأحد", 
					2 => "الأثنين", 
					3 => "الثلاثاء", 
					4 => "الإربعاء", 
					5 => "الخميس" ,
					6 => "الجمعة", 
					7 => "السبت"
				);

		if ($num == "all")
			return $days;
		else
			return $days[$num];

	}

	public function current_week()
	{
		return date("W",strtotime(date("w")==0?"+7 day":"+0 day"));
	}


	public function get_week($weeknum = "current",$json=false)
	{
		if ($weeknum == "current") {
			$weeknum = $this->current_week();
		}

		$shifts = Shift::orderBy("day")->orderBy("period")->orderBy("pos")->get()->where('week',$weeknum);
		$employees = \App\Employee::all()->where('isCashier',true);

		if ($json==="json") return $shifts;
		else return view("shifts.week",compact('shifts','employees','weeknum'));
	}


	public function create_week($year= NULL , $weeknum=NULL)
	{
		
		# Get Next Week's Number
		if ($weeknum == NULL) {
			$weeknum = Shift::max('week')+1;
		}
		if ($year == NULL) {
			$year = date("Y");
		}

		$days = 7;
		$periods = 3;
		$poss = 2;

		for ($day=1; $day <= $days ; $day++) { 
		 for ($period=1; $period <= $periods; $period++) { 
		  for ($pos=1; $pos <= $poss ; $pos++) {

		  	try{
			  	$shift = new Shift;
			  	$shift->year = $year;
			  	$shift->week = $weeknum;
			  	$shift->day = $day;
			  	$shift->period = $period;
			  	$shift->pos = $pos;
			  	$shift->employee = NULL; # TODO: REPEAT LAST WEEKS VALUE;
			  	$shift->value = 75; # TODO: SAME ^
			  	$shift->save();
			}
			catch(\Exception $e) {
		  	    echo $e->getMessage();   // insert query
		  	}

		  	

		  }
		 }
		}

		return view("test");
	}

	


}
