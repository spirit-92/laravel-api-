<?php


namespace App\Http\Controllers\Api;

use App\Model\StatisticUser;
use App\Services\UserStatisticServices;
use DateTime;
use Illuminate\Http\Request;
use Faker\Generator as Faker;

class StatisticUserController
{

    function getUsers(Request $request, UserStatisticServices $userStatistic)
    {
        return $userStatistic->getUsersStatistic($request->page);
    }

    function getUser(Request $request, UserStatisticServices $userStatistic, Faker $faker)
    {
        return $userStatistic->getUserStatistic($request->userId);
    }
}
