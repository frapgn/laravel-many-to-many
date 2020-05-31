<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Tag;
use App\User;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 9; $i++) {
            $tag = new Tag;
            $tag->user_id = User::inRandomOrder()->first()->id;
            $tag->name = $faker->word();
            $tag->save();
        }
    }
}
