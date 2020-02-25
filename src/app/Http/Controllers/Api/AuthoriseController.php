<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AuthoriseGetValidate;
use App\Http\Requests\AuthoriseRequest;
use App\Services\AuthoriseUserServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthoriseController extends Controller
{
    public function auth(AuthoriseRequest $request,AuthoriseUserServices $authService){
        return $authService->auth($request);

    }
    public function authGet(AuthoriseGetValidate $request){
        var_dump('ok');
    }
}
