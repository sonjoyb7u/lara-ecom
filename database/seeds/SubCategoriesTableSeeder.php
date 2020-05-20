<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker_sub_category = Faker\Factory::create();

        foreach (range(1, 10) as $index) {
            $sub_category_name = $faker_sub_category->name;
            SubCategory::create([
                'user_id' => User::get()->random()->id,
                'category_id' => Category::get()->random()->id,
                'sub_category_name' => $sub_category_name,
                'sub_category_slug' => Illuminate\Support\Str::slug($sub_category_name),
                'status' => randomStatus(),
            ]);
        }
    }


}
