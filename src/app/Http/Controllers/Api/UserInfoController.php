<?php

namespace App\Http\Controllers\Api;

use App\Services\InfoUserServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserInfoController extends Controller
{
    function getUserInfo(InfoUserServices $info)
    {
        return response()->json(
            [
                'ip' => $info->get_ip(),
                'OS' => $info->get_os(),
                'Browser' => $info->get_browsers(),
                'Device' => $info->get_device()
            ]
            , 200);
    }

}
