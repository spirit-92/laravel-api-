<?php


namespace App\Services;


use App\Model\PageViews;
use App\Model\StatisticUser;
use App\Model\TotalClicks;
use DateTime;

class UserStatisticServices
{
    function getUsersStatistic($page)
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

    function getUserStatistic($userId)
    {
        $getUser= [];
        $user = StatisticUser::where('id', $userId)->first();
        $totalClicks = TotalClicks::where('clicks_id', $user->id)->get();
        $totalViews = PageViews::where('page_id',$user->id)->get();
        foreach ($totalClicks as $click){
            $date = new DateTime($click->created_at);
            $getUser['month'][]=$date->format('M');
            $getUser['totalClicks'][]= $click->clicks;
        }
        foreach ($totalViews as $view){
            $getUser['totalViews'][]= $view->views;
        }
        return response()->json([
            'user' => $user,
            'statistic'=>$getUser
        ], 200);
    }
}
