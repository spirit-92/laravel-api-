<?php


namespace App\Services;


use App\Model\TokenModel;
use App\Model\UserModel;

class GetUserServices
{
    public function getUser($token)
    {
        $user = TokenModel::whereToken($token)->first()->user;
        return $user;
    }

    public function getAllUser($token)
    {
        $userAuth = TokenModel::whereToken($token)->first()->user;
        $users = [];
        foreach (UserModel::latest('created_at')->get() as $user) {
            if ($user['user_id'] !== $userAuth['user_id']) {
                $users[] = [
                    'user_name' => $user['user_name'],
                    'avatar' => $user['avatar'],
                    'email' => $user['email'],
                    'avatarSocial' => $user['avatarSocial'],
                    'created_at' => explode(' ', $user['created_at'])[0]
                ];
            }
        }
        $userAuth = [
            'user_name' => $userAuth['user_name'],
            'avatar' => $userAuth['avatar'],
            'email' => $userAuth['email'],
            'avatarSocial' => $userAuth['avatarSocial'],
            'created_at' => explode(' ', $userAuth['created_at'])[0]
        ];
        array_unshift($users, $userAuth);
        return $users;
    }
}
