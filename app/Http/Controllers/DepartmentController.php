<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments=Department::get();
        return view('Department.DepartmentTable',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Department.AddDepartment');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $departments=new Department();
        $departments->department_name=$request->department_name;
        $departments->save();
        return redirect()->route('department');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $departments=Department::find($id);
        return view('Department.ShowDepartment',compact('departments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departments=Department::find($id);
        return view('Department.EditDepartment',compact('departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id)
    {
        $departments=Department::find($id);
        $departments->department_name=$request->department_name;
        $departments->save();
        return redirect()->route('department');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departments=Department::findOrFail($id);
        $departments->delete();
        return redirect()->route('department');
    }
}
