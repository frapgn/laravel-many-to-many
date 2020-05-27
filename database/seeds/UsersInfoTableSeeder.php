<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use App\User;
use App\UserInfo;

class UsersInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $number_of_users = DB::table('users')->count();

        for ($i=0; $i < $number_of_users; $i++) {
            $user_info = new UserInfo;
            // $user_info->user_id = $number_of_users;
            $user_info->user_id = $i + 1; // provvisorio
            $user_info->bio = $faker->paragraph(10, false);
            $user_info->linkedin = $faker->url();
            $user_info->twitter = $faker->url();
            $user_info->github = $faker->url();
            $user_info->avatar_path = $faker->url();
            $user_info->save();
        }
    }
}
