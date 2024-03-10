<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleCategory;

class ApiController extends Controller
{
    // function getAllVehicles(Request $request)
    // {
    //     $data = Vehicle::orderby('çreated_at', 'desc')->get();
    //     return response()->json([
    //         'status'=> true,
    //         'data' => $data
    //     ]);
    // }

    // function getVehicleById($id){
    //     $data = Vehicle::whereId($id)->first();
    //     if($data)
    //     {
    //         return response()->json([
    //         'status'=> true,
    //         'data' => $data
    //     ]);
    //     }
    //     return response()->json([
    //         'status'=> false,
    //         'message' => 'Vehicle'
    //     ]);
        
    // }


    public function getVehicles()
    {
        $item = Vehicle::inRandomOrder()->get();
        return response()->json([
            'status' => true,
            'data' => $item
        ]);
    }

    public function getVehiclesByCategory(Request $request)
    {
        $item = Vehicle::where('vehicle_category_id', $request->category_id)->inRandomOrder()->get();
        return response()->json([
            'status' => true,
            'data' => $item
        ]);
    }

    public function getVehicle($id)
    {
        $item = Vehicle::where('id', $id)->first();
        return response()->json([
            'status' => true,
            'data' => $item
        ]);
    }

    public function getCategories()
    {
        $item = VehicleCategory::orderBy('name', 'asc')->get();
        return response()->json([
            'status' => true,
            'data' => $item
        ]);
    }

    public function rentVehicle(Request $request)
    {
        try {
            $data = Rental::where('user_id', auth('api')->user()->id)
                ->where('vehicle_id', $request->vehicle_id)
                ->where('start_date', $request->start_date)
                ->where('end_date', $request->start_date)
                ->first();
            if ($data) {
                return response()->json([
                    'status' => false,
                    'message' => "Order has already been placed"
                ]);
            } else {
                $rent = new Rental([
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'drop_location_id' => $request->drop_location_id,
                    'pick_location_id' => $request->pick_location_id,
                    'vehicle_id' => $request->vehicle_id,
                    'user_id' =>  auth('api')->user()->id,
                    'total_cost' => $request->total_cost,
                    'rental_status' => "Pending",
                ]);

                //if payment then save payment too.
                $rent->save();

                return response()->json([
                    'status' => true,
                    'data' => $rent
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => "Something went wrong"
            ]);
        }
    }

    public function getUserRentalDetails($id)
    {
        $rent = Rental::where('id', $id)->first();
        if ($rent) {
            if ($rent->user_id == auth('api')->user()->id) {

                return response()->json([
                    'status' => true,
                    'data' => $rent
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Unauthorized access"
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "Order not found"
            ]);
        }
    }

    public function getUserRentals()
    {
        $rent = Rental::where('user_id', auth('api')->user()->id)->get();

        return response()->json([
            'status' => true,
            'data' => $rent
        ]);

    }

    public function updateRentalStatus(Request $request, $id)
    {
        $rent = Rental::where('id', $id)->first();
        if ($rent) {
            if ($rent->user_id == auth('api')->user()->id) {
                $rent->update([
                    'rental_status' => $request->status,
                ]);

                return response()->json([
                    'status' => true,
                    'data' => $rent
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Unauthorized access"
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "Order not found"
            ]);
        }
    }

    public function updateRental(Request $request, $id)
    {
        $rent = Rental::where('id', $id)->first();
        if ($rent) {
            if ($rent->user_id == auth('api')->user()->id) {
                $rent->update([
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'drop_location_id' => $request->drop_location_id,
                    'pick_location_id' => $request->pick_location_id,
                    'vehicle_id' => $request->vehicle_id,
                ]);

                return response()->json([
                    'status' => true,
                    'data' => $rent
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Unauthorized access"
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "Order not found"
            ]);
        }
    }
}
