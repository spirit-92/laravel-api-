<?php


namespace App\Services;


use App\Http\Requests\ValidateMusicRequest;
use App\Model\AllMusicModel;

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
    public function saveMusic(ValidateMusicRequest $music){
//        var_dump($_FILES['audio']['type'][0]);die();
        foreach ($music->audio as $key=>$value){

            $path = $value->storeAs("public/uploads/test/",$_FILES['audio']['name'][$key]);
            var_dump($path);
        }

    }
}
