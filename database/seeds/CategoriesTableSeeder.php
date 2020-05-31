<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 7; $i++) {
            $category = new Category;
            $category->user_id = User::inRandomOrder()->first()->id;
            $category->name = $faker->word();
            $category->description = $faker->sentence(6, false);
            $category->save();
        }
    }
}
