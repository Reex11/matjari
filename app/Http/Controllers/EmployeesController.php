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


}
