<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function getAccountInfo(Request $request){
        $account = Account::all();

        $data = [
            'accounts' => $account,
        ];

        return response()->json($data, 200);
    }
}
