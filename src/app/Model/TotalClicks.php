<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TotalClicks extends Model
{
    protected $table = 'totalClicks';
    protected $fillable = ['clicks_id','clicks'];
    public $timestamps = false;
    public $updated_at = false;
}
