<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class UserStatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 1; $i <= 250; $i++) {
            DB::table('statistic_user')->insert([
                'first_name' => $faker->firstName,
                'last_name' =>  $faker->lastName,
                'email' => $faker->email,
                'gender' => 'male',
                'ip_address'=>  $faker->localIpv4,

            ]);
        }

    }
}
