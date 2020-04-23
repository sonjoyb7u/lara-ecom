<?php

use App\Models\Category;
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
                'user_id' => random_int(1, 2),
                'brand_id' => random_int(1, 10),
                'category_name' => $category_name,
                'category_slug' => Illuminate\Support\Str::slug($category_name),
                'status' => random_int(0, 1),

            ]);
        }
    }
}
