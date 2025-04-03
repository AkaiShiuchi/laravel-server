<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Category;

class CategorySeeder extends Seeder
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
        $description = [
            'Burgers' => 'Món ăn nhanh, đầy đủ và ngon miệng.',
            'Fries' => 'Khoai tây chiên giòn, món ăn vặt tuyệt vời.',
            'Snacks' => 'Các món ăn nhẹ dễ dàng mang đi.',
            'Drinks' => 'Các loại nước giải khát mát lạnh.',
            'Wraps' => 'Món cuộn nhẹ nhàng và dễ ăn.',
            'Salads' => 'Salad tươi mát và bổ dưỡng.',
            'Desserts' => 'Món tráng miệng ngọt ngào, hấp dẫn.',
        ];

        for ($i = 0; $i < 7; $i++) {
            $name = ['Burgers', 'Fries', 'Snacks', 'Drinks', 'Wraps', 'Salads', 'Desserts'];

            $data[] = [
                'name' => $name[$i],
                'description' => $description[$name[$i]],
            ];
        }

        if (!empty($data)) {
            Category::insert($data);
        }
    }
}
