<?php

namespace App\Http\Controllers\Api;

use App\Services\GetUserServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
  public function getAllUser(Request $request, GetUserServices $user){
    return response()->json(
        $user->getAllUser($request->header('token'))
    ,200);
  }
}
