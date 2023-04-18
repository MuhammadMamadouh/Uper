<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\LoginNeedsVerification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class LoginController extends Controller
{
    //

    public function submit(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|min:10',
        ]);

        $user = User::firstOrCreate([
            'phone' => $request->phone,
        ]);

        if (!$user) {
            return response()->json(['message' => 'Couldnt process a user with this phone', 401]);
        }
        $rand = rand(1111111, 9999999);
        $user->login_code = $rand;
        $user->save();
        // FacadesNotification::send($user, new LoginNeedsVerification);
        // $user->notfiy(new LoginNeedsVerification);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|min:10',
            'login_code' => 'required|numeric',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return response()->json(['message' => 'Couldnt process a user with this phone', 401]);
        }

        if ($user->login_code == $request->login_code) {
            $user->login_code = null;
            $user->save();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token, 'user' => $user], 200);
        } else {
            return response()->json(['message' => 'Invalid code', 401]);
        }
    }
}
