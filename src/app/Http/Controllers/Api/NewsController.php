<?php

namespace App\Http\Controllers\Api;

use App\Services\NewsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function saveNews(NewsService $news, Request $request)
    {
        $status = $news->saveNews($request->header('token'), $request);
        if ($status) {
            return response()->json([
                'status' => 'add News'
            ], 200);
        } else {
            return response()->json([
                'status' => 'Новость уже добавлена'
            ], 500);
        }

    }

    public function getNews(Request $request, NewsService $news)
    {
        return response()->json($news->getNews($request->header('token')), 200);
    }

    public function deleteNews(Request $request, NewsService $news)
    {
        $status = $news->deleteNews($request->header('token'), $request->newsId);
        if ($status) {
            return response()->json([
                'status' => 'delete news'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error'
            ], 500);
        }

    }
}
