<?php

use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker_category = Faker\Factory::create();

        foreach (range(1, 10) as $index) {
            $category_name = $faker_category->name;
            Category::create([
                'user_id' => User::get()-random()->id,
                'category_name' => $category_name,
                'category_slug' => Str::slug($category_name),
                'status' => random_int(0, 1),

            ]);
        }
    }
}
