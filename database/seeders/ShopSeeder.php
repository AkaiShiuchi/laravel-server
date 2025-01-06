<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;
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
        $foodIds = range(1, 11);

        for ($i = 0; $i < 100; $i++) {
            $randomFoodIds = $faker->randomElements($foodIds, $faker->numberBetween(1, 11));
            $imageUrl = 'https://picsum.photos/640/480?random=' . time();

            $data[] = [
                'food_id' => json_encode(array_map(function($id) {
                    return ['food_id' => $id];
                }, $randomFoodIds)),
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
