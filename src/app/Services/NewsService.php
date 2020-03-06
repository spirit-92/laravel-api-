<?php


namespace App\Services;


use App\Model\BaseNewModels;
use App\Model\TokenModel;
use App\Model\UserNewsModel;
use Illuminate\Http\Request;


class NewsService
{
    public function getNews($token)
    {
        $giveNews = [];
        $token = TokenModel::whereToken($token)->first();
        $news = UserNewsModel::whereUserId($token['user_id'])->get();
        foreach ($news as $new) {
            $giveNews[] = [
                'id' => $new->news['id_news'],
                'title' => $new->news['title'],
                'img' => $new->news['img'],
                'url' => $new->news['url'],
                'publish_news' => $new->news['publish_news'],
                'author' => $new->news['author'],
                'created_at' => $new->news['created_at']->toDateTimeString()
            ];
        }
        return $giveNews;
    }

    public function saveNews(string $token, Request $request)
    {
        $user_id = TokenModel::whereToken($token)->first()->user;
        if (BaseNewModels::whereTitle($request->title)->first()) {
            $newsId = BaseNewModels::whereTitle($request->title)->first();
            if (UserNewsModel::where('user_id', $user_id['user_id'])->where('news_id', $newsId['id_news'])->first()) {
                return false;
            } else {
                (new UserNewsModel([
                    'user_id' => $user_id['user_id'],
                    'news_id' => $newsId['id_news']
                ]))->save();
            }
        } else {
            (new BaseNewModels([
                'title' => $request->title,
                'img' => $request->img,
                'url' => $request->url,
                'publish_news' => $request->publish_news,
                'author' => $request->author
            ]))->save();
            $newsId = BaseNewModels::whereTitle($request->title)->first();
            (new UserNewsModel([
                'user_id' => $user_id['user_id'],
                'news_id' => $newsId['id_news']
            ]))->save();
        }
        return true;
    }


    public function deleteNews(string $token, $idNews)
    {
        $user_id = TokenModel::whereToken($token)->first()->user;
        $statusDelete = UserNewsModel::where('user_id', $user_id['user_id'])->where('news_id', $idNews)->delete();
        if ($statusDelete) {
            if (!UserNewsModel::where('news_id', $idNews)->first()) {
                BaseNewModels::where('id_news',$idNews)->delete();
            }
        } else {
            return false;
        }
        return true;
    }
}
