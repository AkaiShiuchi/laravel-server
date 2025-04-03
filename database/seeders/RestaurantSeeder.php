<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
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

        for ($i = 0; $i < 7; $i++) {
            $date = $faker->dateTimeThisYear;


            $name = ['Burgers & Fries', 'QuickBite', 'Snack Shack', 'Fast Feast', 'Burger Corner',  'Fry & Fly',  'Chomp Express'];
            $vehicle = ['motorcycle', 'car'];
            $lat = $faker->latitude($min = -90, $max = 90);
            $long = $faker->longitude($min = -180, $max = 180);
            $bio = $this->getBio();

            $data[] = [
                'name' => $name[$i],
                'bio' => $bio,
                'rating' => round(rand(10, 50) / 10, 1),
                'delivery_cost' => rand(10, 50),
                'delivery_vehicle' => $vehicle[array_rand($vehicle)],
                'delivery_time' => rand(10, 50),
                'lat' => $lat,
                'long' => $long,
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }

        if (!empty($data)) {
            Restaurant::insert($data);
        }
    }

    protected function getBio() {
        $bio = [
            'Best pizza in town',
            'Home of the Whopper',
            'Fresh Japanese cuisine',
            'Authentic Mexican flavors',
            'Italian cuisine at its finest'
        ];

        return $bio[array_rand($bio)];
    }
}
