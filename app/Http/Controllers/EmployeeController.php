<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Job;
use App\Models\Service;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees=Employee::get();
        return view('Employee.EmployeeTable',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $departments = Department::get();
        $jobs=Job::get();
        $services=Service::get();
        return view('Employee.AddEmployee',compact('departments', 'jobs', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $employees=new Employee();
        $employees->first_name=$request->first_name;
        $employees->last_name=$request->last_name;
        $employees->email=$request->email;
        $employees->city=$request->city;
        $employees->address=$request->address;
        $employees->salary=$request->salary;
        $employees->phone_number=$request->phone_number;
        $employees->hiredate=$request->hiredate;
        $employees->birthdate=$request->birthdate;
        $employees->job_id=$request->job_id;
        $employees->department_id=$request->department_id;
        $employees->service_id=$request->service_id;
        $employees->save();
        return redirect()->route('employee');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employees=Employee::find($id);
        return view('Employee.ShowEmployee',compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employees=Employee::find($id);
        $departments = Department::get();
        $jobs=Job::get();
        $services=Service::get();
        return view('Employee.EditEmployee',compact('employees','departments', 'jobs', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, string $id)
    {
        $employees=Employee::find($id);
        $employees->first_name=$request->first_name;
        $employees->last_name=$request->last_name;
        $employees->email=$request->email;
        $employees->city=$request->city;
        $employees->address=$request->address;
        $employees->salary=$request->salary;
        $employees->phone_number=$request->phone_number;
        $employees->hiredate=$request->hiredate;
        $employees->birthdate=$request->birthdate;
        $employees->job_id=$request->job_id;
        $employees->department_id=$request->department_id;
        $employees->service_id=$request->service_id;
        $employees->save();
        return redirect()->route('employee');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employees=Employee::findOrFail($id);
        $employees->delete();
        return redirect()->route('employee');
    }
}
