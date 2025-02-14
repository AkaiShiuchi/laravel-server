<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\WebUser;
use Session;

class LoginController extends Controller
{
    public function login() {
        return view('login.index');
    }

    public function handle(Request $request) {
        try {
            $email = $request->email;
            $password = $request->password;
            $user = WebUser::where('email', $email)->first();

            if (!$user) {
                return back();
            }

            if (Hash::check($password, $user->password)) {
                Session::put('user_id', $user->id);
                return redirect()->route('management.index');
            } else {
                return back();
            }
        } catch (Exception $e) {
            Log::error(__FILE__ . " : " . __LINE__ . " >>" . $e);
        }
    }
}
