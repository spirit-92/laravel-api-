<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PageViews extends Model
{
    protected $table = 'pageViews';
    protected $fillable = ['page_id','views'];
    public $timestamps = false;
    public $updated_at = false;
}
