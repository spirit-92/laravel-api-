<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TokenModel extends Model
{
    protected $table = 'token';
    protected $fillable = ['user_id', 'token'];
    public $timestamps = true;
    public $updated_at = false;

    public function user()
    {
        return $this->hasOne('App\Model\UserModel', 'user_id');
    }
}
