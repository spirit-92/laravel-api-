<?php


namespace App\Services;

use App\Http\Requests\ValidateMusicRequest;
use App\Http\Requests\ValidateTitleMusicReguest;
use App\Model\AllMusicModel;
use App\Model\TokenModel;
use App\Model\UserMusicModel;
use Illuminate\Http\Request;

class MusicServices
{
    public function getAllMusic()
    {
        $musics = [];
        foreach (AllMusicModel::all() as $music) {
            $musics[] = [
                'title' => $music['title'],
                'link' => $music['url']
            ];
        }
        return $musics;
    }

    public function saveMusic(ValidateMusicRequest $music)
    {
        $status = [];
        foreach ($music->audio as $key => $value) {
            $title = str_replace('.mp3', '', $_FILES['audio']['name'][$key]);
            if (!$this->validateTitle($title)) {
                $path = $value->storeAs("/public/uploads/musicAll", $_FILES['audio']['name'][$key]);
                $path = str_replace('public', 'storage', $path);
                (new AllMusicModel([
                    'url' => $path,
                    'title' => $title
                ]))->save();
                $status['success'][] = $title . " - save";
            } else {
                $status['error'][] = $title . " -this track has already been recorded";
            }
        }
        return $status;

    }

    public function validateTitle(string $title)
    {
        return AllMusicModel::where('title', $title)->exists();
    }

    public function saveUserMusic(ValidateTitleMusicReguest $reguest, string $token)
    {
        $user_id = TokenModel::whereToken($token)->first()->user;
        $music_id = AllMusicModel::where('title', $reguest->title)->first();
        if (!UserMusicModel::where('user_id', $user_id['user_id'])->where('music_id', $music_id['music_id'])->exists()) {
            (new UserMusicModel([
                'user_id' => $user_id['user_id'],
                'music_id' => $music_id['music_id']
            ]))->save();
            return response()->json([
                'status' => 'save'
            ], 200);
        } else {
            return response()->json([
                'status' => 'this song has already been added'
            ], 400);
        }
    }

    public function getFavoriteMusic($token)
    {
        $giveMusic = [];
        $user_id = TokenModel::whereToken($token)->first()->user;
        $musicUser = UserMusicModel::where('user_id', $user_id['user_id'])->get();
        foreach ($musicUser as $music){
            $giveMusic[] = [
                'title' => $music->music['title'],
                'link' => $music->music['url']
            ];
        }
       return $giveMusic;
    }
    public function deleteMusic(Request $request){
        $user_id = TokenModel::whereToken($request->header('token'))->first()->user;
        $music_id = AllMusicModel::where('title',$request->title)->first();
        $statusDelete = UserMusicModel::
        where('user_id', $user_id['user_id'])->
        where('music_id', $music_id['music_id'])->
        delete();
        if ($statusDelete){
            return response()->json([
                'status' => 'success delete'
            ], 200);
        }else{
            return response()->json([
                'status' => 'error delete music'
            ], 400);
        }
    }
}
