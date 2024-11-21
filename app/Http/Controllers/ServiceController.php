<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services=Service::get();
        return view('Service.ServiceTable',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Service.AddService');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $services=new Service();
        $services->service_name=$request->service_name;
        $services->description=$request->description;
        $services->save();
        return redirect()->route('service');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $services=Service::find($id);
        return view('Service.ShowService',compact('services'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $services=Service::find($id);
        return view('Service.EditService',compact('services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, string $id)
    {
        $services=Service::find($id);
        $services->service_name=$request->service_name;
        $services->description=$request->description;
        $services->save();
        return redirect()->route('service');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $services=Service::findOrFail($id);
        $services->delete();
        return redirect()->route('service');
    }
}
