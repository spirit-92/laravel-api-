<?php


namespace App\Services;


use App\Model\TokenModel;
use App\Model\UserModel;

class GetUserServices
{
  public function getUser($token){
      $userId = TokenModel::whereToken($token)->first();
      $user = UserModel::whereUserId($userId['user_id'])->first();

      return $user;
  }
}
