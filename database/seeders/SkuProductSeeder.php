<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\ProductClasstification;
use App\Models\Product;

class SkuProductSeeder extends Seeder
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
        $product = Product::all();
        $total = $product->count();
        $size = ['9', '12', '15'];
        $sku = 1;

        for ($i = 1; $i <= $total; $i++) {
            $date = $faker->dateTimeThisYear;

            for ($k = 1; $k <= count($size); $k++) {
                $data[] = [
                    'sku' => $sku++,
                    'product_id' => $product[$i - 1]->id,
                    'unit' => 'inch',
                    'size' => $size[$k - 1],
                    'cost' => rand(1, 10) * 10,
                ];
            }
        }

        if (!empty($data)) {
            ProductClasstification::insert($data);
        }
    }
}
