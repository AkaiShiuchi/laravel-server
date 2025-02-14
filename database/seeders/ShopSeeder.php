<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\Food;
use Faker\Factory as Faker;

class ShopSeeder extends Seeder
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

        for ($i = 0; $i < 50; $i++) {
            $n = rand(1, 10);
            $food = Food::inRandomOrder()->take($n)->pluck('id')->toArray();
            $imageUrl = 'https://picsum.photos/640/480?random=' . rand(1, 10000);

            $data[] = [
                'food_id' => json_encode(array_map(function($key) {
                    return [
                        'food_id' => $key
                    ];
                }, $food)),
                'shop_name' => $faker->company,
                'image' => $imageUrl,
                'delivery' => rand(0, 1),
                'time_ship' => rand(10, 40),
                'evaluate' => rand(1, 5)
            ];

            if ($i % 10 == 0) {
                Shop::insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            Shop::insert($data);
        }
    }
}
