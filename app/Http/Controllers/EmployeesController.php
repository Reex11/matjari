<?php

namespace App\Http\Controllers;

use App\Employee;

class EmployeesController extends Controller
{
    
    public function index()
    {
    	$employees = Employee::all();
		return view("employees.index",compact('employees'));
	}

	public function create()
	{
		return view("employees.create");
	}

	public function store()
	{

		$employee = new Employee();
		$employee->name = request('employeename');
		$employee->phone = request('phone');

		if (request('cSalary') == null) $employee->constantSalary = 0;
		else 							$employee->constantSalary = request('cSalary');
		
		if(request('isCashier') == "on") $employee->isCashier = true;
		else						 	 $employee->isCashier = false;
		
		$employee->save();

		return redirect('/employees');
	}

	public function edit(Employee $employee)
	{
		return view("employees.edit",compact('employee'));
	}

	public function update(Employee $employee)
	{
		$employee->name = request('employeename');
		$employee->phone = request('phone');
		if (request('cSalary') == null) $employee->constantSalary = 0;
		else 							$employee->constantSalary = request('cSalary');
		if(request('isCashier') == "on") $employee->isCashier = true;
		else						 	 $employee->isCashier = false;
		$employee->save();
		return redirect('/employees');
	}

	// DO BE MOVED TO SALARIES CONTROLLER
	public function get_month_shifts_value($employee_id, $untill = "all", $month = NULL, $year = NULL )
	{
		
		if ($untill === "today") $untill = date("d");
		if ($year === NULL) $year = date("Y");
		if ($month === NULL) $month = date("m");

		$month = sprintf("%02d", $month);
		$start_date = $year."-".$month."-01";
		if ($untill === "all") {
			$untill_date = date("Y-m-t",strtotime($start_date));
		} else {
			$untill = sprintf("%02d", $untill);
			$untill_date = $year."-".$month."/".$untill;
		}

			$total = 00.00;

		$shifts = \App\Shift::all()
									->where('employee',$employee_id)
									->where('year',$year)
									->where('date','>=',$start_date)
									->where('date','<=',$untill_date);
		
		

		foreach ($shifts as $shift) {
			$total = $total + $shift->value;
		}

		return number_format($total, 2);
	}

	// TO BE INTIATED
	// ( DONT ALLOW DELETE FOR EXISTING SALARIES )
	public function destroy()
	{
	}

	public function show(Employee $employee)
	{
		// TODO: CHANGE TO SALARIES CONTROLLER FUNCTION
		// TODO: ADD LAST 5 MONTHS SALARIES PREVIEW
		// TODO: ADD LAST 5 REWARDS
		return view('employees.show',compact('employee'));
	}


}
