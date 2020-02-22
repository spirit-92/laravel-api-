<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserValidate;
use App\Http\Requests\RegistrationValidate;
use Illuminate\Http\Request;
use App\Services\RegistrationUserService;

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
     * @return \Illuminate\Http\JsonResponse
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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
