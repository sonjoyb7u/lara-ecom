<?php

use App\Models\User;
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
                'user_id' => User::get()->random()->id,
                'message' => $faker_slider->state,
                'title' => $faker_slider->city,
                'sub_title' => $faker_slider->sentence,
                'url' => $faker_slider->imageUrl(),
//                'status' => randomStatus(),
            ]);
        }
    }
}
