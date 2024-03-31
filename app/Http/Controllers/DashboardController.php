<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleCategory;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $info['totalUsers'] = User::count();
        $info['totalOrders'] = Rental::count();
        $info['totalVehicles'] = Vehicle::count();
        $info['totalVehicleCategory'] = VehicleCategory::count();
        $info['rentals'] = Rental::where('start_date', '>', Carbon::today())
            ->whereRentalStatus('Pending')->get();

        return view('home', $info);
    }
}
