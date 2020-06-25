<?php


namespace App\Http\Controllers\Api;
use App\Services\UserStatisticServices;
use Illuminate\Http\Request;

class StatisticUserController
{

    function getUser(Request $request ,  UserStatisticServices $userStatistic)
    {
     return $userStatistic->getUserStatistic($request->page);
    }
}
