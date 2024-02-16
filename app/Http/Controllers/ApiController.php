<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class ApiController extends Controller
{
    function vehicles(Request $request)
    {
        return Vehicle::all();
    }
}
