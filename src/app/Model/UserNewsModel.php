<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserNewsModel extends Model
{
    protected $table = 'user_news';
    protected $fillable = ['user_id','news_id'];
    public $timestamps = false;
    public function news()
    {
        return $this->hasOne('App\Model\BaseNewModels', 'id_news','news_id');
    }
}
