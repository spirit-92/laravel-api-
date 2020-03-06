<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseNewModels extends Model
{
    protected $table = 'base_news';
    protected $fillable = ['title','img','url','publish_news','author'];
    public $timestamps = true;
    public $updated_at = false;
}
