<?php


namespace App\Services;


use App\Model\TokenModel;
use App\Model\UserModel;

class GetUserServices
{
  public function getUser($token){
      $userId = TokenModel::whereToken($token)->first()->user;
//      $user = UserModel::whereUserId($userId['user_id'])->first();
      $user = TokenModel::whereToken($token)->first()->user;
      return $user;

  }
}
