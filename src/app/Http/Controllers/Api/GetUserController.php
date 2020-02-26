<?php

namespace App\Http\Controllers\Api;

use App\Services\GetUserServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetUserController extends Controller
{

    public function getUser(Request $request, GetUserServices $getUser)
    {
        $user = $getUser->getUser($request->header('token'));
        return response()->json([
            'user'=> $user
        ],200);
    }


}
