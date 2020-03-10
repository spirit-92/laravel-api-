<?php


namespace App\Services;

use App\Model\TokenModel;
use App\Model\UserModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Faker;

class AuthoriseUserServices
{
    public function auth(Request $request)
    {
        $faker = Faker\Factory::create();
        $user = UserModel::whereEmail($request->get('email'))->first();

        if (!$user) {
            return null;
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'body' => 'password invalid'
            ], 400);
        }
        $tokensUser = TokenModel::whereUserId($user['user_id'])->get()->count();

        TokenModel::whereUserId($user['user_id'])
            ->where('created_at', '<', Carbon::now()->subMinutes(config('app')['lifetimeTokenMin'])->toDateTimeString())->delete();

        if ($tokensUser <= 3) {
            $token = $faker->uuid();
            (new TokenModel([
                'user_id' => $user['user_id'],
                'token' => $token
            ]))->save();
            return response([
                'token' => $token
            ], 200);
        } else {
            $token = TokenModel::whereUserId($user['user_id'])->first();
            return response([
                'token' => $token['token']
            ], 200);
        }

    }

}
