<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\OrderProduct;
use App\Models\ProductClasstification;

class OrderProductSeeder extends Seeder
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
            $date = $faker->dateTimeThisYear;
            $productSku = ProductClasstification::inRandomOrder()->first();
            $data[] = [
                'product_sku' => $productSku->sku,
                'amount' => rand(1, 5),
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }

        if (!empty($data)) {
            OrderProduct::insert($data);
        }
    }
}
