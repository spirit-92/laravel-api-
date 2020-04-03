<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserPhilosophyModel extends Model
{
    protected $table = 'user_philosophy';
    protected $fillable = ['user_id','update','philosophy_id'];
    public $timestamps = false;
    public function philosophy()
    {
        return $this->hasOne('App\Model\AllPhilosophy', 'philosophy_id','philosophy_id');
    }
}
