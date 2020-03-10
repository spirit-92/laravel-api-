<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AddUserValidate;
use App\Http\Requests\RegistrationValidate;
use App\Services\RegistrationUserService;

use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{

    public function save(AddUserValidate $request, RegistrationUserService $user)
    {
        return  $user->registerUser($request);
    }

    public function store(RegistrationValidate $request)
    {
        return response()->json([
            'status'=>'success'
        ],200);
    }
}
