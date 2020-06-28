<?php


use App\Models\Brand;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Str;


class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker_brand = Faker\Factory::create();

        foreach(range(1, 10) as $index) {
            $brand_name = $faker_brand->unique()->name;

            Brand::create([
                'user_id' => User::get()->random()->id,
                'brand_name' => $brand_name,
                'brand_slug' => Str::slug($brand_name),
                'status' => random_int(0, 1),
            ]);

        }


    }
}
