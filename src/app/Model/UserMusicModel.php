<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserMusicModel extends Model
{
    protected $table = 'user_music';
    protected $fillable = ['user_id','music_id'];
    public $timestamps = false;
    public function music()
    {
        return $this->hasOne('App\Model\AllMusicModel', 'music_id','music_id');
    }
}
