<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_faker = Faker\Factory::create();

        foreach (range(1, 10) as $index) {
            $title = $product_faker->jobTitle;
            Product::create([
                'user_id' => User::all()->random()->id,
                'brand_id' => Brand::all()->random()->id,
                'category_id' => Category::all()->random()->id,
                'sub_category_id' => SubCategory::all()->random()->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'desc' => $product_faker->realText(),
                'code' => random_int(1000, 1500),
                'sales_price' => random_int(1000.000, 3500.000),
                'status' => randomStatus(),
            ]);
        }
    }
}
