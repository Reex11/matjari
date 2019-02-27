<?php

namespace App\Http\Controllers;

use App\Shift;

class ShiftsController extends Controller
{
    
	// views

	public function view_week($year = "current", $weeknum = "current",$json=false)
	{
		if ($weeknum == "current") {
			$weeknum = $this->current_week();
		}
		if ($year == "current") {
			$year = date("Y");
		}

		$shifts = $this->get_week($year,$weeknum);
		$employees = \App\Employee::all()->where('isCashier',true);

		if ($json==="json") return $shifts;
		else return view("shifts.week-view",compact('shifts','employees','weeknum','year'));
	}

	public function edit_week($year = "current", $weeknum = "current")
	{
		if ($weeknum == "current") {
			$weeknum = $this->current_week();
		}
		if ($year == "current") {
			$year = date("Y");
		}

		$shifts = $this->get_week($year,$weeknum);
		$employees = \App\Employee::all()->where('isCashier',true);

		return view("shifts.week-edit",compact('shifts','employees','weeknum','year'));
	}

	// workers

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

	public function get_week($year = "current",$weeknum = "current")
	{
		if ($weeknum == "current") {
			$weeknum = $this->current_week();
		}
		if ($year == "current") {
			$year = date("Y");
		}

		$weeknum = (int)$weeknum;
		$year = (int)$year;
		
		return Shift::orderBy("day")->orderBy("period")->orderBy("pos")->get()->where('week',$weeknum)->where('year',$year);
	}

	public static function create_week($year= NULL , $weeknum=NULL)
	{
		
		# Get Next Week's Number
		if ($weeknum == NULL) {
			$weeknum = Shift::max('week')+1;
		}
		if ($year == NULL) {
			$year = date("Y");
		}

		$days = 7; // TODO: TO BE CHANGED TO DEFAULT VALUE SETTING
		$periods = 3; // TODO: TO BE CHANGED TO DEFAULT VALUE SETTING
		$poss = 2; // TODO: TO BE CHANGED TO DEFAULT VALUE SETTING

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
			  	$shift->employee = NULL; // TODO: REPEAT LAST WEEKS VALUE;
			  	$shift->value = 75; // TODO: TO BE CHANGED TO DEFAULT VALUE SETTING
			  	$shift->save();
			}
			catch(\Exception $e) {
		  	    echo $e->getMessage();   // insert query
		  	}

		  }
		 }
		}

	}


	public function update_week()
	{
		
		return request()->all();
	}


	// HELPERS

	public function current_week()
	{
		return date("W",strtotime(date("w")==0?"+7 day":"+0 day"));
	}

	// public function isset_week($weeknum)
	// {
	// 	if ($weeknum == NULL) {
	// 		$weeknum = Shift::max('week')+1;
	// 	}
	// 	return date("W",strtotime(date("w")==0?"+7 day":"+0 day"));
	// }
	


}
