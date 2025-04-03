<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Shipper;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $data = [];

        for ($i = 0; $i < 5; $i++) {
            $delivery_vehicle = ['motorcycle', 'car'];
            $payment_method = ['Paypal', 'VNPay', 'ZaloPay'];
            $date = $faker->dateTimeThisYear;
            $endDate = $faker->dateTimeInInterval($date, '+2 month');
            // $user = User::inRandomOrder()->first();
            $user = User::orderBy('id', 'desc')->first();
            $user_id = $user->id;
            $address = UserAddress::inRandomOrder()->first();
            $address_id = $address->id;
            $shipper = Shipper::first();
            $shipper_id = $shipper->id;
            $restaurant = Restaurant::inRandomOrder()->first();
            $product = Product::where('restaurant_id', $restaurant->id)->inRandomOrder()->take(rand(1,5))->pluck('id')->toArray();
            $list_products = implode(',', $product);

            $data[] = [
                "delivery_vehicle" => $delivery_vehicle[array_rand($delivery_vehicle)],
                "payment_method" => $payment_method[array_rand($payment_method)],
                "order_date" => $date,
                "amount" => rand(100, 1000),
                "status" => rand(1, 3),
                "user_id" => $user_id,
                "user_address_id" => $address_id,
                "list_products" => $list_products,
                "shipper_id" => $shipper_id,
                "created_at" => $date,
                "updated_at" => $endDate,
            ];

            if ($i % 10 == 0) {
                Order::insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            Order::insert($data);
        }
    }
}
