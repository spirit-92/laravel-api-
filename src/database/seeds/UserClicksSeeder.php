<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;
use App\Model\StatisticUser;

class UserClicksSeeder extends Seeder
{
    public function run(Faker $faker, Carbon $carbon)
    {
        for ($i = 1; $i <= StatisticUser::all()->count(); $i++) {
            $date = new DateTime();
            $today = $date->setTimestamp($date->getTimestamp());
            $month = 2592000;
            $totalCliks = 0;
            $totalPage = 0;
            for ($i2 = 1; $i2 <= 6; $i2++) {
                $randClicks = $faker->numberBetween($min = 200, $max = 1000);
                $randPage = $faker->numberBetween($min = 200, $max = 1000);
                DB::table('totalClicks')->insert([
                    'clicks_id' => $i,
                    'clicks' => $randClicks,
                    'created_at' => $today->format('Y-m-d H:i:s')
                ]);
                DB::table('pageViews')->insert([
                    'page_id' => $i,
                    'views' => $randPage,
                    'created_at' => $today->format('Y-m-d H:i:s')
                ]);
                $totalCliks += $randClicks;
                $totalPage += $randPage;
                $today = $date->setTimestamp($date->getTimestamp() - $month);
            }
            $user = StatisticUser::where('id',$i)->first();
            $user->total_clicks = $totalCliks;
            $user->page_views = $totalPage;
            $user->save();
        }


    }
}
