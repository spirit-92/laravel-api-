<?php

namespace App\Http\Controllers\Api;

use App\Services\GetUserServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param GetUserServices $getUser
     * @return void
     */
    public function getUser(Request $request, GetUserServices $getUser)
    {
        $user = $getUser->getUser($request->header('token'));
       var_dump($user);
    }


}
