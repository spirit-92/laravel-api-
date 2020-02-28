<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $fillable = ['user_id', 'title','body','img'];
    public $timestamps = true;
    public $updated_at = false;
}
