<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Department;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs=Job::get();
        return view('Job.JobTable',compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::get();
        return view('Job.AddJob',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        $jobs=new Job();
        $jobs->job_title=$request->job_title;
        $jobs->min_salary=$request->min_salary;
        $jobs->max_salary=$request->max_salary;
        $jobs->department_id=$request->department_id;
        $jobs->save();
        return redirect()->route('job');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobs=Job::find($id);
        return view('Job.ShowJob',compact('jobs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobs=Job::find($id);
        $departments = Department::get();
        return view('Job.EditJob',compact('jobs'),compact('departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, string $id)
    {
        $jobs=Job::find($id);
        $jobs->job_title=$request->job_title;
        $jobs->min_salary=$request->min_salary;
        $jobs->max_salary=$request->max_salary;
        $jobs->department_id=$request->department_id;
        $jobs->save();
        return redirect()->route('job');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobs=Job::findOrFail($id);
        $jobs->delete();
        return redirect()->route('job');
    }
}
