<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AllMusicModel extends Model
{
    protected $table = 'all_music';
    protected $fillable = ['url','title'];
    public $timestamps = true;
    public $updated_at = false;
}
