<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use App\User;
use App\MasterData;

class MasterDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $number_of_users = DB::table('users')->count();

        // Prende gli utenti che non hanno la relazione espressa dalla funzione info()
        // Fra le parentesi scrivere il nome stringato di tale funzione
        $users = User::doesntHave('master_data')->get();

        foreach ($users as $user) {
            $master_data = new MasterData;
            $master_data->user_id = $user->id;
            $master_data->bio = $faker->paragraph(10, false);
            $master_data->linkedin = $faker->url();
            $master_data->twitter = $faker->url();
            $master_data->github = $faker->url();
            $master_data->avatar_path = $faker->url();
            $master_data->save();
        }
    }
}
