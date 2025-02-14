<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Coupon;

class CouponSeeder extends Seeder
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

        for ($i = 0; $i < 10; $i++) {
            $date = $faker->dateTimeThisYear;
            $endDate = $faker->dateTimeInInterval($date, '+2 month');
            $image = rand(1, 10000);
            $imageUrl = 'https://picsum.photos/640/480?random=' . $image;
            $imageName = $image . 'jpg';

            $data[] = [
                "name" => $faker->word(),
                "discount" => (rand(1, 10) * 5),
                "created_day" => $date,
                "expired_day" => $endDate,
                "amount" => rand(10, 20),
                // "grand_by" => ,
                "created_at" => $date,
                "updated_at" => $date
            ];

            if ($i % 10 == 0) {
                Coupon::insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            Coupon::insert($data);
        }
    }
}
