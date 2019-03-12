<?php

namespace App\Http\Controllers;

use App\Reward;
use App\Employee;
use Illuminate\Http\Request;

class RewardsController extends Controller
{

    public function index($all = NULL)
    {
        $employees = \App\Employee::select('id','name')->get();
        $rewards = Reward::orderBy('id','desc')->take(5)->get();

        return view("rewards.index",compact('employees','rewards'));

    }

    public function create()
    {
        $employees = Employee::select('id','name')->get();
        return view("rewards.create",compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Reward::create( request()->all() );
        return redirect('/rewards');
    }

    public function employeeRewards(\App\Employee $employee)
    {

        $rewards = Reward::where('employee',$employee->id);
        return view("rewards.employee",compact('rewards','employee'));
    }
    

    public function show(Reward $reward)
    {
        $employee = Employee::findOrFail($reward->employee);
        return view("rewards.show",compact('reward','employee'));
    }

    public function edit(Reward $reward)
    {
        $employees = Employee::select('id','name')->get();
        $employee = Employee::findOrFail($reward->employee);
        $msgs = [["warning" => "أنت الآن تقوم بالتعديل"]];
        return view("rewards.edit",compact('reward','employees','employee','msgs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reward $reward)
    {
        $reward->fill(request()->all());
        $reward->save();
        return redirect('/rewards');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reward $reward)
    {
        $reward->delete();
        return redirect()->back()->with('msgs',[['warning' => 'تم حذف العملية بنجاح.']]);;
    }
}
