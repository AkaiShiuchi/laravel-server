<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $size = ['10', '14', '16'];
        $locations = ['China', 'Italy', 'Mexico', 'USA', 'France'];
        $foodTypes = ['Pizza', 'Hamburger', 'Sandwich', 'Pasta', 'Salad'];

        for ($i = 0; $i < 10; $i++) {
            $imageUrl = 'https://picsum.photos/640/480?random=' . rand(1, 10000);
            $randomLocation = $locations[array_rand($locations)];
            $randomFoodType = $foodTypes[array_rand($foodTypes)];

            $data[] = [
                "name" => $faker->word(),
                "description" => $faker->sentence(),
                "price" => rand(10, 300),
                "stars" => rand(1, 5),
                "size" => json_encode($size),
                "food_type" => $randomFoodType,
                "people" => rand(1, 10),
                "selected_people" => rand(1, 10),
                "img" => $imageUrl,
                "location" => $randomLocation,
                "type_id" => rand(2, 3)
            ];

            if ($i % 10 == 0) {
                Food::insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            Food::insert($data);
        }
    }
}
