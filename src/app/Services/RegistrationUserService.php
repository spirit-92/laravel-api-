<?php
namespace App\Services;
use App\Http\Requests\AddUserValidate;
use App\Model\TokenModel;
use App\Model\UserModel;
use Faker;
use Illuminate\Support\Facades\Hash;

class RegistrationUserService
{
    public function registerUser(AddUserValidate  $request){
        $faker = Faker\Factory::create();
        $tokenGenerate = $faker->uuid();
        (new UserModel([
            'user_name'=>$request->name,
            'password'=>Hash::make($request->get('password')),
            'email'=>$request->email
        ]))->save();

        $user = UserModel::whereUserName($request->name)->first('user_id');
        (new TokenModel([
            'user_id' => $user['user_id'],
            'token' => $tokenGenerate,
        ]))->save();

        return response([
            'token'=>$tokenGenerate
        ],200);
    }
}
