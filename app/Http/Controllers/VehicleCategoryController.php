<?php

namespace App\Http\Controllers;

use App\Models\VehicleCategory;
use Illuminate\Http\Request;

class VehicleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = VehicleCategory::all();
        return view("vehicleCategories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehicleCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //ad validation here
        $request->validate([

        ]);
        $data = $request->all();
        $VehicleCategory = new VehicleCategory($data);
        $VehicleCategory->save();

        return redirect()->route('vehicleCategories.index')->with('success', 'VehicleCategory added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info['item'] = VehicleCategory::findOrFail($id);
        return view('vehicleCategories.show', $info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info['item'] = VehicleCategory::findOrFail($id);
        return view('vehicleCategories.edit', $info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //add validation here
        $request->validate([

        ]);
        $data = $request->all();
        $VehicleCategory = VehicleCategory::findOrFail($id);
        $VehicleCategory->update($data);
        return redirect()->route('vehicleCategories.index')->with('success', 'Vehicle Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $VehicleCategory = VehicleCategory::findOrFail($id);
            $VehicleCategory->delete();
            return redirect()->route('vehicleCategories.index')->with('success', 'Vehicle Category deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
