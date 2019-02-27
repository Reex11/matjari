<?php

namespace App\Http\Controllers;

use App\Employee;

class EmployeesController extends Controller
{
    
    public function index($json=false) {

    	$employees = Employee::all();

    	if ($json==="json") return $employees;
		else return view("employees.index",compact('employees'));
		
	}

	public function create() {

		return view("employees.create");
	}

	public function store() {

		//return request()->all();


		$employee = new Employee();

		$employee->name = request('employeename');

		if (request('cSalary') == null) $employee->constantSalary = 0;
		else 							$employee->constantSalary = request('cSalary');
		$employee->phone = request('phone');
		
		if(request('isCashier') == "on") $employee->isCashier = true;
		else						 	 $employee->isCashier = false;
		
		$employee->save();

		return redirect('/employees');
	}

	public function edit($id)
	{
		$employee = Employee::findorfail($id);
		return view("employees.edit",compact('employee'));
	}

	public function update($id)
	{
		$employee = Employee::findorfail($id);
		$employee->name = request('employeename');
		if (request('cSalary') == null) $employee->constantSalary = 0;
		else 							$employee->constantSalary = request('cSalary');
		$employee->phone = request('phone');
		if(request('isCashier') == "on") $employee->isCashier = true;
		else						 	 $employee->isCashier = false;
		$employee->save();
		return redirect('/employees');
	}

	public function destroy()
	{

	}

	public function show($id)
	{
		$employee = Employee::findorfail($id);

		return view('employees.show',compact('employee'));
	}


}
