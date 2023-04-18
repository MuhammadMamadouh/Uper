<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverRequest;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    //
    public function show(Request $request)
    {
        // return back the user and associated driver model
        $user = $request->user();
        $user->load('driver');

        return $user;
    }

    public function update(DriverRequest $request)
    {

        $user = $request->user();

        $user->update($request->only('name'));

        // create or update a driver associated with this user
        $user->driver()->updateOrCreate($request->only([
            'year',
            'make',
            'model',
            'color',
            'license_plate'
        ]));

        $user->load('driver');

        return $user;
    }
}
