<?php


namespace App\Services;


use App\Http\Requests\ValidateMusicRequest;
use App\Model\AllMusicModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
}
