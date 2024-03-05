<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class ApiController extends Controller
{
    function getAllVehicles(Request $request)
    {
        $data = Vehicle::orderby('çreated_at', 'desc')->get();
        return response()->json([
            'status'=> true,
            'data' => $data
        ]);
    }

    function getVehicleById($id){
        $data = Vehicle::whereId($id)->first();
        if($data)
        {
            return response()->json([
            'status'=> true,
            'data' => $data
        ]);
        }
        return response()->json([
            'status'=> false,
            'message' => 'Vehicle'
        ]);
        
    }
}
