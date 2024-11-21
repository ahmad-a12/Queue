<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeatRequest;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seats=Seat::get();
        return view('Seat.SeatTable',compact('seats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Seat.AddSeat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeatRequest $request)
    {
        $seats=new Seat();
        $seats->number=$request->number;
        $seats->save();
        return redirect()->route('seat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $number)
    {
        $seats=Seat::find($number);
        return view('Seat.ShowSeat',compact('seats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $number)
    {
        $seats=Seat::find($number);
        return view('Seat.EditSeat',compact('seats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SeatRequest $request, string $number)
    {
        $seats=Seat::find($number);
        $seats->number=$request->number;
        $seats->save();
        return redirect()->route('seat');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $number)
    {
        $seats=Seat::findOrFail($number);
        $seats->delete();
        return redirect()->route('seat');
    }
}
