<?php

namespace App\Http\Controllers;


use App\Http\Resources\RentalResource;
use App\Models\Location;
use App\Models\Payment;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleCategory;

class ApiController extends Controller
{
    public function getVehicles()
    {
        $item = Vehicle::with(['category'])->inRandomOrder()->get();
        return response()->json([
            'status' => true,
            'data' => $item
        ]);
    }

    public function getVehiclesByCategory(Request $request)
    {
        $category = VehicleCategory::where('id', $request->category_id)->first();
        if ($category) {
            $item = Vehicle::where('vehicle_category_id', $request->category_id)->inRandomOrder()->get();
            return response()->json([
                'status' => true,
                'data' => $item
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "No such category found"
            ]);
        }
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
        $item = VehicleCategory::with(['vehicles'])->orderBy('name', 'asc')->get();
        return response()->json([
            'status' => true,
            'data' => $item
        ]);
    }

    public function rentVehicle(Request $request)
    {
        try {
            $data = Rental::with(['vehicle'])->where('user_id', auth('api')->user()->id)
                ->where('vehicle_id', $request->vehicle_id)
                ->where('start_date', $request->start_date)
                ->where('end_date', $request->end_date)
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
                    'vehicle_id' => $request->vehicle_id,
                    'user_id' => auth('api')->user()->id,
                    'total_cost' => $request->total_cost,
                    'rental_status' => "Pending",
                    'latlon' => $request->latlon,

                ]);

                //if payment then save payment too.
                $rent->save();

                return response()->json([
                    'status' => true,
                    'data' => $rent->load('vehicle')
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function getUserRentalDetails($id)
    {
        $rent = Rental::with(['payment'])->where('id', $id)->first();
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
        $rent = Rental::with(['payment'])->where('user_id', auth('api')->user()->id)->get();

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
                    'rental_status' => $request->rental_status,
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
        $data = $request->all();
        $rent = Rental::where('id', $id)->first();
        if ($rent) {
            if ($rent->user_id == auth('api')->user()->id) {

                if($rent->status != "Pending") {
                    return response()->json(['status' => false, 'message' => 'This order cannot be updated']);
                }
                if ($request->drop) {
                    $drop_location_name = $request->drop['location_name'];
                    $drop_lat_lon = explode(' ', $request->drop['latlon']);


                    $drop_location = Location::firstOrCreate([
                        'name' => $drop_location_name,
                        'latitude' => $drop_lat_lon[0],
                        'longitude' => $drop_lat_lon[1],
                    ]);

                    $data['drop_location_id'] = $drop_location->id;
                }

                if ($request->pickup) {
                    $pickup_location_name = $request->pickup['location_name'];
                    $pickup_lat_lon = explode(' ', $request->pickup['latlon']);

                    $pickup_location = Location::firstOrCreate([
                        'name' => $pickup_location_name,
                        'latitude' => $pickup_lat_lon[0],
                        'longitude' => $pickup_lat_lon[1],
                    ]);
                    $data['pick_location_id'] = $pickup_location->id;

                }
                $rent->update($data);
                $rent = $rent->load(['vehicle', 'payment']);

                return response()->json([
                    'status' => true,
                    'data' => new RentalResource($rent)
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

    public
    function verifyPayment(Request $request)
    {
        $token = $request->token;
        $amount = $request->amount;

        $args = http_build_query(array(
            'token' => $token,
            'amount' => $amount
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

// Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Authorization: test_secret_key_b76acf9c6944411c90462f5fcc220707'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $response;
    }

    public
    function checkout(Request $request)
    {
        $validate = $request->validate([
            'reference_id' => 'required',
            'amount' => 'required',
            'payment_status' => 'required'
        ]);

        try {

            $drop_location_name = $request->drop['location_name'];
            $pickup_location_name = $request->pickup['location_name'];
            $drop_lat_lon = explode(' ', $request->drop['latlon']);
            $pickup_lat_lon = explode(' ', $request->pickup['latlon']);


            $drop_location = Location::firstOrCreate([
                'name' => $drop_location_name,
                'latitude' => $drop_lat_lon[0],
                'longitude' => $drop_lat_lon[1],
            ]);
            $pickup_location = Location::firstOrCreate([
                'name' => $pickup_location_name,
                'latitude' => $pickup_lat_lon[0],
                'longitude' => $pickup_lat_lon[1],
            ]);

            $rent = new Rental([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'vehicle_id' => $request->vehicle_id,
                'user_id' => auth('api')->user()->id,
                'total_cost' => $request->total_cost,
                'rental_status' => "Pending",
                'drop_location_id' => $drop_location->id,
                'pick_location_id' => $pickup_location->id,
            ]);

            //if payment then save payment too.
            $rent->save();
            $payment = Payment::create([
                'reference_id' => $request->reference_id,
                'payment_amount' => $request->amount,
                'payment_status' => $request->payment_status,
                'payment_date' => Carbon::now(),
                'rental_id' => $rent->id
            ]);

            $rent = $rent->load(['vehicle', 'payment']);
            return response()->json([
                'status' => true,
                'data' => new RentalResource($rent)
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }
}
