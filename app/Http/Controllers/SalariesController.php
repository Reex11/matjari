<?php

namespace App\Http\Controllers;

use App\Salary;
use App\Employee;
use App\Reward;
use App\Shift;
use Illuminate\Http\Request;

class SalariesController extends Controller
{

    public function index()
    {
        // list of months
        $months = Salary::groupBy('year')->groupBy('month')->orderBy('year','desc')->orderBy('month','desc')->select('year','month','updated_at')->get();
        return view('salaries.index',compact('months'));
        return $months;
    } 

    public function listByMonth($year,$month)
    {
        // show table of employees dues (Salaries) for a month with a total of dues
        $salaries = NULL;
        $employees = Employee::select('id','name')->get();
        if (Salary::where('month',$month)->where('year',$year)->count() >= 1)
            $salaries = Salary::where('month',$month)->where('year',$year)->orderBy('year','desc')->orderBy('month','asc')->get();
        return view("salaries.bymonth-list",compact('salaries','employees','year','month'));
        //return $salaries;
    }

    public function listByEmployee($id)
    {
        // show table of one employee dues (Salaries)
        $employee = Employee::findOrFail($id);
        $salaries = NULL;
        if (Salary::where('employee',$employee->id)->count() >= 1)
            $salaries = Salary::where('employee',$employee->id)->get();
        return $salaries;
    }


    public function show(Salary $salary)
    {
        return $salary;
    }

    public function create($year = NULL, $month = NULL, $employee = NULL)
    {   
        $employee = Employee::findOrFail($employee);
        $salary = $this->calculate($year,$month,$employee->id);
        $create = Salary::updateOrCreate ([
            'year'              => $year,
            'month'             => $month,
            'employee'          => $employee->id
        ],[
            'constantSalary'    => $salary['constantSalary'],
            'totalShifts'       => $salary['totalShifts'],
            'totalRewards'      => $salary['totalRewards'],
            'totalDeducts'      => $salary['totalDeducts'],
            'total'             => $salary['total']
        ]);

        return $create;
    }

    public function store(Request $request)
    {
        $salary = $this->calculate($year,$month,$employee);
        Salary::create ([
            'year'              => request('year'),
            'month'             => request('month'),
            'employee'          => request('employee'),
            'constantSalary'    => $salary['constantSalary'],
            'totalShifts'       => $salary['totalShifts'],
            'totalRewards'      => $salary['totalRewards'],
            'totalDeducts'      => $salary['totalDeducts'],
            'total'             => $salary['total']
        ]);
        return redirect('/rewards');
    }

    public function edit(Salary $salary)
    {
        //
    }
    
    public function update(Request $request, Salary $salary)
    {
        //
    }

    public function destroy(Salary $salary)
    {
        //
    }

    public function createMonth(Request $request)
    {   
        $employees = Employee::select('id')->get();
        foreach ($employees as $employee)
            $this->create($request->year,$request->month,$employee->id);

        return redirect('/salaries');
    }

    public function recalculateMonth($year, $month, $employee)
    {
        //
    }

    public function recalculate($year, $month, $employee)
    {
        $salary = Salary::where('year',$year)->where('month',$month)->where('employee',$employee);
        $salary = $this->calculate($year,$month,$employee);
    }

    public function calculate($year, $month, $employeeid)
    {
        $date = strtotime($year.'-'.$month.'-01');
        $datefrom = date("Y-m-d",$date);
        $dateto = date("Y-m-t",$date);
        $employee = Employee::findOrFail($employeeid);
        $rewards = Reward::where('employee',$employee->id)->whereBetween('created_at',[$datefrom,$dateto])->get();
        $shifts = Shift::where('employee_id',$employee->id)->whereBetween('date',[$datefrom,$dateto])->get();
        $salary = Array();

        $salary['constantSalary']   = $employee->constantSalary;
        $salary['totalShifts']      = 0;
        $salary['totalRewards']     = 0;
        $salary['totalDeducts']     = 0;
        $salary['total']            = 0;
        
        foreach ($rewards as $reward) {
            if ($reward->isDeduct) $salary['totalDeducts'] += $reward->amount;
            else $salary['totalRewards'] += $reward->amount;
        }

        foreach ($shifts as $shift) {
            $salary['totalShifts'] += $shift->value;
        }

        $salary['total'] += $salary['constantSalary'];
        $salary['total'] += $salary['totalShifts'];
        $salary['total'] += $salary['totalRewards'];
        $salary['total'] -= $salary['totalDeducts'];
        

        $salary['totalShifts']  = sprintf("%.2f", $salary['totalShifts']);
        $salary['totalRewards'] = sprintf("%.2f", $salary['totalRewards']);
        $salary['totalDeducts'] = sprintf("%.2f", $salary['totalDeducts']);
        $salary['total']        = sprintf("%.2f", $salary['total']);

        
        return $salary;
    }

}
