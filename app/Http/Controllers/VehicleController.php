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
            'vehicle_name' => 'required|string',
            'model' => 'required|string',
            'cost_per_hour' => 'required|string',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4048',
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
            'vehicle_description' => 'required|string',
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

        return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info['vehicle'] = Vehicle::findOrFail($id);
        return view('vehicles.show', $info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info['vehicle'] = Vehicle::findOrFail($id);
        $info['categories'] = VehicleCategory::all();

        return view('vehicles.edit', $info);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fuel_type' => 'required|string',
            'vehicle_name' => 'required|string',
            'model' => 'required|string',
            'cost_per_hour' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4048', // Change to nullable
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
            'vehicle_description' => 'required|string',
        ]);

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->fuel_type = $request->input('fuel_type');
        $vehicle->vehicle_name = $request->input('vehicle_name');
        $vehicle->model = $request->input('model');
        $vehicle->cost_per_hour = $request->input('cost_per_hour');
        $vehicle->vehicle_category_id = $request->input('vehicle_category_id');
        $vehicle->vehicle_description = $request->input('vehicle_description');

        if ($request->hasFile('image_url')) {
            Storage::delete($vehicle->image_url);

            $imagePath = $request->file('image_url')->store('vehicle_images', 'public');
            $vehicle->image_url = Storage::url($imagePath);
        }
        $vehicle->save();
        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $Vehicle = Vehicle::findOrFail($id);
            $Vehicle->delete();
            return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
