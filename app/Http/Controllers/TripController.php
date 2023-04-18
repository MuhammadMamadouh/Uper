<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripController extends Controller
{
    //


    public function store(Request $request)
    {

        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'destination_name' => 'required'
        ]);
        $user = $request->user();

        $trip = $user->trips()->create($request->only([
            'driver_id',
            'start_address',
            'end_address',
            'start_time',
            'end_time',
            'distance',
            'fare',
            'rating'
        ]));

        return $trip;
    }
}
