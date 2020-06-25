<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StatisticUser extends Model
{
    protected $table = 'statistic_user';
    protected $fillable = ['first_name','last_name','email','gender','ip_address','total_clicks','page_views'];

}
