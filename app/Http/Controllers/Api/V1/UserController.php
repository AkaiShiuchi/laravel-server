<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:account',
            'phone' => 'required|unique:account|regex:/^(\+?[\d]{1,4}[\s\-]?)?[\d]{1,10}$/',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'The first name field is required.',
            'phone.required' => 'The  phone field is required.',
            'phone.regex' => 'The number is not valid.',
            'email.unique' => 'This email already exist.'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => "Failed Validation"], 403);
        }

        $user = User::checkUserExist($request->email);
        if (!$user) {
            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);
        }
        $user = $user ? $user : $newUser;
        $userId = $user->id;

        $newAccount = Account::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'user_id' => $userId,
        ]);

        $token = $user->createToken('RestaurantCustomerAuth')->accessToken;
       
        return response()->json([
            'success' => 200 ,
            'token' => $token,
            'user_id' => $userId,
        ], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required_without:email|regex:/^(\+?[\d]{1,4}[\s\-]?)?[\d]{1,10}$/',
            'email' => 'required_without:phone|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $account = $request->phone ? 'phone' : 'email';
        $data = [
            $account => $request->phone ? $request->phone : $request->email,
            'password' => $request->password
        ];
        
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('RestaurantCustomerAuth')->accessToken;
          
            return response()->json([
                'success' => 200,
                'token' => $token, 
                'id' => auth()->user()->id,
            ], 200);
        } else {
            $errors = [];
            array_push($errors, ['code' => 'auth-001', 'message' => 'Unauthorized.']);
            return response()->json([
                'errors' => $errors
            ], 401);
        }
    }
}
