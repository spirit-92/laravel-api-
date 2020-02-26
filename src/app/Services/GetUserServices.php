<?php


namespace App\Services;


use App\Model\TokenModel;
use App\Model\UserModel;

class GetUserServices
{
  public function getUser($token){
      $user = TokenModel::whereToken($token)->first()->user;
      return $user;
  }
}
