<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        //DB::table('categories')->truncate();
        Category::truncate();

        for ($i = 0; $i < 30; $i++) {
            $categoryName = rtrim($faker->sentence(1),'.');
            Category::create([
                'name' => $categoryName,
                'slug'=>Str::slug($categoryName)
            ]);
        }
    }
}
