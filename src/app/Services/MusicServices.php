<?php


namespace App\Services;


use App\Http\Requests\ValidateMusicRequest;
use App\Model\AllMusicModel;
use Illuminate\Support\Facades\Storage;

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


        foreach ($music->audio as $key=>$value){
            $path = $value->storeAs("public/uploads/test",$_FILES['audio']['name'][$key]);
            $title = str_replace('public/uploads/test/', '', $path);

            var_dump($title);
            (new AllMusicModel([
                'url' => $path,
                'title'=>$title = str_replace('.mp3', '', $path)
            ]))->save();
        }

    }
}
