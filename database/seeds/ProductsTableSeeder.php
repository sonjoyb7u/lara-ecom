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
                'user_id' => User::get()->random()->id,
                'brand_id' => Brand::get()->random()->id,
                'category_id' => Category::get()->random()->id,
                'sub_category_id' => SubCategory::get()->random()->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'desc' => 'Generate Lorem Ipsum placeholder text. Select the number of characters, words, sentences or paragraphs, and hit generate',
                'long_desc' => $product_faker->realText(),
                'product_code' => randomCode(),
                'product_model' => randomModel(),
                'product_color' => randomColor(),
                'product_size' => randomSize(),
                'gallery' => $product_faker->imageUrl(),
                'product_video_url' => $product_faker->imageUrl(),
                'quantity' => rand(1, 5),
//                'warranty_duration' => randomWarrantyDuration(),
//                'warranty_condition' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
//                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'original_price' => rand(800, 1200),
                'sales_price' => rand(1250, 2500),
//                'special_price' => rand(830, 1250),
//                'special_start' => $product_faker->dateTime(),
//                'special_end' => $product_faker->dateTime(),
//                'offer_price' => rand(810, 1220),
//                'offer_start' => $product_faker->dateTime(),
//                'offer_end' => $product_faker->dateTime(),
                'available' => randomProductAvailable(),
                'status' => randomStatus(),

            ]);
        }
    }
}
