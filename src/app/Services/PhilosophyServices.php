<?php


namespace App\Services;


use App\Http\Requests\PhilosophyFavoriteValidate;
use App\Http\Requests\ValidateIdPhilosophy;
use App\Http\Requests\ValidatePhilosophyRequest;
use App\Model\AllPhilosophy;
use App\Model\TokenModel;
use App\Model\UserModel;
use App\Model\UserPhilosophyModel;
use http\Env\Request;


class PhilosophyServices
{
    public function savePhilosophy(ValidatePhilosophyRequest $request, $token)
    {
        $user = TokenModel::whereToken($token)->first()->user;
        if ($request->image) {
            $path = $request->file('image')->storeAs("/public/uploads/imgPhilosophy/" . $user['user_name'], $_FILES['image']['name']);
            (new AllPhilosophy([
                'title' => $request->title,
                'body' => $request->body,
                'url' => $path
            ]))->save();
        } else {
            (new AllPhilosophy([
                'title' => $request->title,
                'body' => $request->body,
            ]))->save();
        }
        $philosophy_id = AllPhilosophy::where('title', $request->title)->first();
        (new UserPhilosophyModel([
            'user_id' => $user['user_id'],
            'update' => true,
            'philosophy_id' => $philosophy_id['philosophy_id']
        ]))->save();

        return response()->json([
            'status' => 'this philosophy added'
        ], 200);
    }

    public function getPhilosophy($email, $token)
    {
        $givePhilosophy = [];
        $userGivePhilosophy = UserModel::where('email', $email)->first();
        $user = TokenModel::whereToken($token)->first()->user;
        $userPhilosophy = UserPhilosophyModel::where('user_id', $userGivePhilosophy['user_id'])->get();

        foreach ($userPhilosophy as $philosophy) {
            $philosophy->philosophy['url'] = str_replace('public/', '', $philosophy->philosophy['url']);

            $givePhilosophy[] = [
                'philosophy_id' => $philosophy->philosophy['philosophy_id'],
                'title' => $philosophy->philosophy['title'],
                'body' => $philosophy->philosophy['body'],
                'img' => $philosophy->philosophy['url'],
                'author' => $user['user_name'],
                'update' => $userGivePhilosophy['user_id'] === $user['user_id'] ? true : false,
                'canUpdate' => $philosophy['update'],
                'created_at' => $philosophy->philosophy['created_at']
            ];
        }
        return response()->json([
            'philosophy' => $givePhilosophy
        ], 200);

    }

    public function putPhilosophy(ValidateIdPhilosophy $request, $token)
    {
        $user = TokenModel::whereToken($token)->first()->user;
        $philosophyUpdate = UserPhilosophyModel::where('user_id', $user['user_id'])->where('philosophy_id', $request->id)->first();
        $update = [];
        if ($philosophyUpdate) {
            if ($request->title) {
                $philosophyUpdate->philosophy()->update([
                    'title' => $request->title,
                ]);
                $update['title'] = $request->title;
            }
            if ($request->body) {
                $philosophyUpdate->philosophy()->update([
                    'body' => $request->body
                ]);
                $update['body'] = $request->body;
            }
            if (!$request->body && !$request->title) {
                return response()->json([
                    'status' => 'dont have title or body'
                ], 400);
            }
            return response()->json([
                'update' => $update
            ], 200);

        } else {
            return response()->json([
                'status' => 'error'
            ], 400);
        }
    }

    public function favoritePhilosophy(PhilosophyFavoriteValidate $request, $token)
    {
        $user = TokenModel::whereToken($token)->first()->user;
        if (!UserPhilosophyModel::where('user_id', $user['user_id'])->where('philosophy_id', $request->philosophy_id)->exists()) {
            (new UserPhilosophyModel([
                'user_id' => $user['user_id'],
                'update' => false,
                'philosophy_id' => $request->philosophy_id
            ]))->save();
            return response()->json([
                'status' => 'save'
            ], 200);
        } else {
            return response()->json([
                'status' => 'this philosophy already exists'
            ], 400);
        }
    }

    public function deleteFavoritePhilosophy(PhilosophyFavoriteValidate $request, $token)
    {
        $user = TokenModel::whereToken($token)->first()->user;
        $statusDelete = UserPhilosophyModel::where('user_id', $user['user_id'])->where('philosophy_id', $request->philosophy_id)->delete();
        if ($statusDelete) {
            if (!UserPhilosophyModel::where('philosophy_id', $request->philosophy_id)->first()) {
                AllPhilosophy::where('philosophy_id', $request->philosophy_id)->delete();
            }
        } else {
            return response()->json([
                'status' => 'false'
            ], 400);
        }
        return response()->json([
            'status' => 'delete'
        ], 200);
    }
}
