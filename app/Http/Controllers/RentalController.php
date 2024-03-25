<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rentals = Rental::all();
        return view("manageRental.index", compact("rentals"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info['rental'] = Rental::findOrFail($id);
        return view('manageRental.show', $info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        
        $info['rental'] = Rental::findOrFail($id);
        return view('manageRental.edit', $info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([

        ]);
        $data = $request->all();
        $Rental = Rental::findOrFail($id);
        $Rental->update($data);
        return redirect()->route('rentals.index')->with('success', 'Rental updated successfully!'); //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    }
}
