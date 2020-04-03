<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\EmailValidateRequest;
use App\Http\Requests\PhilosophyFavoriteValidate;
use App\Http\Requests\ValidateIdPhilosophy;
use App\Http\Requests\ValidatePhilosophyRequest;
use App\Services\PhilosophyServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhilosophyController extends Controller
{
    public function savePhilosophy(ValidatePhilosophyRequest $request, PhilosophyServices $philosophy)
    {
        return $philosophy->savePhilosophy($request, $request->header('token'));
    }

    public function getPhilosophy(EmailValidateRequest $request, PhilosophyServices $philosophy)
    {
        return $philosophy->getPhilosophy($request->email, $request->header('token'));
    }

    public function putPhilosophy(ValidateIdPhilosophy $request, PhilosophyServices $philosophy)
    {
        return $philosophy->putPhilosophy($request, $request->header('token'));
    }

    public function saveFavoritePhilosophy(PhilosophyFavoriteValidate $request, PhilosophyServices $philosophy)
    {
        return $philosophy->favoritePhilosophy($request, $request->header('token'));
    }

    public function deletePhilosophy(PhilosophyFavoriteValidate $request, PhilosophyServices $philosophy)
    {
        return $philosophy->deleteFavoritePhilosophy($request, $request->header('token'));
    }
}
