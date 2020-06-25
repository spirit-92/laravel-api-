<?php


namespace App\Services;


use App\Model\StatisticUser;

class UserStatisticServices
{
    function getUserStatistic($page)
    {
        $users = StatisticUser::all()->forPage($page, 16);
        $countUser = round(ceil(StatisticUser::all()->count() / 16));
        $giveUser = [];
        foreach ($users as $user) {
            $giveUser[] = [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'gender' => $user->gender,
                'ip_address' => $user->ip_address,
                'total_clicks' => $user->total_clicks,
                'page_views' => $user->page_views,
            ];
        }
        return response()->json([
            'countUser' => $countUser,
            'users' => $giveUser
        ], 200);
    }

}
