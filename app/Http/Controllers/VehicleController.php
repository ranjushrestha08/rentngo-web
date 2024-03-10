<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        return view("vehicles.index", compact("vehicles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = VehicleCategory::all();
        return view("vehicles.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fuel_type' => 'required|string',
            'model' => 'required|string',
            'cost_per_hour' => 'required|string',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
        ]);

        $imagePath = $request->file('image_url')->store('vehicle_images', 'public');

        $vehicle = new Vehicle([
            'fuel_type' => $request->input('fuel_type'),
            'vehicle_name' => $request->input('vehicle_name'),
            'model' => $request->input('model'),
            'cost_per_hour' => $request->input('cost_per_hour'),
            'image_url' => Storage::url($imagePath),
            'vehicle_category_id' => $request->input('vehicle_category_id'),
            'vehicle_description' => $request->input('vehicle_description'),
        ]);

        $vehicle->save();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
