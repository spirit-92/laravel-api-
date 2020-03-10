<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ValidateMusicRequest;
use App\Http\Requests\ValidateTitleMusicReguest;
use App\Services\GetUserServices;
use App\Services\MusicServices;
use App\Services\NewsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MusicController extends Controller
{

    public function getUser(Request $request, GetUserServices $getUser)
    {
        $user = $getUser->getUser($request->header('token'));
        return response()->json([
            'user' => $user
        ], 200);
    }

    public function getAllMusic(MusicServices $musics)
    {
        return response()->json($musics->getAllMusic(), 200);
    }

    public function saveMusic(ValidateMusicRequest $request, MusicServices $musics)
    {
        return response()->json([
            'status' => $musics->saveMusic($request)
        ], 200);
    }

    public function saveUserMusic(ValidateTitleMusicReguest $request, MusicServices $musics)
    {
     return  $musics->saveUserMusic($request, $request->header('token'));
    }
    public function getFavoriteMusic(Request $request,MusicServices $music){

        return response()->json($music->getFavoriteMusic($request->header('token')), 200);
    }
    public function deleteFavoriteMusic(Request $request, MusicServices $music){
     return   $music->deleteMusic($request);
    }
}
