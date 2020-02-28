<?php

namespace App\Http\Controllers\Api;

use App\Services\GetUserServices;
use App\Services\SaveNewsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function getUser(Request $request, GetUserServices $getUser)
    {
        $user = $getUser->getUser($request->header('token'));
        return response()->json([
            'user' => $user
        ], 200);
    }

    public function saveNews(SaveNewsService $news, Request $request)
    {
        $news = $news->saveNews($request->header('token'), $request);
        return $news;
    }


}
