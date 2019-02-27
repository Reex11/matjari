<?php

namespace App\Http\Controllers;

use App\Shift;

class ShiftsController extends Controller
{
    
	// views

	public function show($year = "current", $weeknum = "current")
	{
		if ($weeknum == "current") {
			$weeknum = $this->current_week();
		}
		if ($year == "current") {
			$year = date("Y");
		}

		$shifts = $this->get_week($year,$weeknum);
		$employees = \App\Employee::all()->where('isCashier',true);

		return view("shifts.week-view",compact('shifts','employees','weeknum','year'));
	}

	public function edit($year = "current", $weeknum = "current")
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

	

	public function create($year = NULL , $weeknum = NULL, $fromyear = NULL, $fromweeknum = NULL)
	{
		
		# Get Next Week's Number
		if ($weeknum == NULL) 
			$weeknum = Shift::max('week')+1;
			if ($weeknum < $this->current_week()) $weeknum = $this->current_week();
		if ($year == NULL) 
			$year = date("Y");

		if ($fromweeknum == NULL)
			$fromweeknum = Shift::max('week');

		if ($fromyear == NULL)
			$fromyear = date("Y");

		if ( is_null(Shift::where("year",$fromyear)->where("week",$fromweeknum)->first()) )
			$create_default_values = true;
		else 
			$create_default_values = false;

		$days = 7; // TODO: TO BE CHANGED TO DEFAULT VALUE SETTING
		$periods = 3; // TODO: TO BE CHANGED TO DEFAULT VALUE SETTING
		$poss = 2; // TODO: TO BE CHANGED TO DEFAULT VALUE SETTING

		if ( is_null(Shift::where("year",$year)->where("week",$weeknum)->first()) ) {

			if (!$create_default_values) {
			  	
			
					$inhert_shifts = Shift::
						where("year",$fromyear)
						->where("week",$fromweeknum)
						->get();
				
				foreach ($inhert_shifts as $inhert_shift) {
					$shift = new Shift;
			  	  	$shift->year = $year;
			  	  	$shift->week = $weeknum;
			  	  	$shift->day = $inhert_shift->day;
			  	  	$shift->period = $inhert_shift->period;
			  	  	$shift->pos = $inhert_shift->pos;
					$shift->employee = $inhert_shift->employee;
			  		$shift->value = $inhert_shift->value; 
			  	  	$shift->save();
			  	}

			} else {


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
								$shift->employee = NULL; 
								$shift->value = 75; 

							  	$shift->save();
						}
						catch(\Exception $e) {
					  	    echo $e->getMessage();   // insert query
					  	}

					  }
					 }
					}
			}



		}






		return redirect('/shifts/'.$year.'/'.$weeknum);
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
		$year = request('year');
		$weeknum = request('weeknum');

		foreach ($shifts as $id => $new) {
			$shift = Shift::find($id);
			$shift->value = $new['value'];

			$shift->employee = $new['employee'];
			$shift->save();
		}
		
		return redirect("/shifts/".$year."/".$weeknum);
	}


	// HELPERS

	public function current_week()
	{
		return date("W",strtotime(date("w")==0?"+7 day":"+0 day"));
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

	// public function isset_week($weeknum)
	// {
	// 	if ($weeknum == NULL) {
	// 		$weeknum = Shift::max('week')+1;
	// 	}
	// 	return date("W",strtotime(date("w")==0?"+7 day":"+0 day"));
	// }
	


}
