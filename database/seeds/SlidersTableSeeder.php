<?php

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker_slider = Faker\Factory::create();

        foreach (range(1, 5) as $index) {
            Slider::create([
                'user_id' => random_int(1, 2),
                'message' => $faker_slider->state,
                'title' => $faker_slider->city,
                'sub-title' => $faker_slider->sentence,
                'url' => $faker_slider->imageUrl(),
                'status' => randomStatus(),
            ]);
        }
    }
}
