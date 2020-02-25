<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AddUserValidate;
use App\Http\Requests\RegistrationValidate;
use App\Http\Requests\ValidateAvatarRequest;
use App\Services\SaveAvatarServices;
use Illuminate\Http\Request;
use App\Services\RegistrationUserService;

use App\Http\Controllers\Controller;

class ValidationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param AddUserValidate $request
     * @param RegistrationUserService $user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
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
