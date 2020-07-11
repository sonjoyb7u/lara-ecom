<?php

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Product;
use App\Models\CustomerReview;


class CustomersReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker_customer_review = Faker\Factory::create();

        foreach (range(1, 50) as $index) {
            CustomerReview::create([
                'customer_id' => Customer::get()->random()->id,
                'product_id' => Product::get()->random()->id,
                'message' => $faker_customer_review->paragraph,
                'rating' => rand(1, 5),
                'status' => randomCustomerReviewStatus(),
            ]);
        }
    }
}
