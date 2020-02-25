<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $fillable = ['user_name','password','email','avatar'];
    public $timestamps = false;
    public $updated_at = false;
}
