<?php


namespace App\Services;


use App\Model\NewsModel;
use App\Model\TokenModel;
use Illuminate\Http\Request;

class SaveNewsService
{
    public function saveNews(string $token,Request $request){
        $user_id = TokenModel::whereToken($token)->first()->user;
        (new NewsModel([
            'user_id'=>$user_id["user_id"],
            'title'=>$request->title,
            'body'=>$request->body,
            'img'=> $request->img
        ]))->save();

        return response()->json([
            "status"=>"success"
        ],200);
    }
}
