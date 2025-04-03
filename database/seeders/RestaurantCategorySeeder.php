<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use App\Models\Category;

class RestaurantCategorySeeder extends Seeder
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

        $restaurants = [
            'Burgers & Fries' => [
                ['name' => 'Classic Burger', 'category' => 'Burgers'],
                ['name' => 'Cheese Burger', 'category' => 'Burgers'],
                ['name' => 'Chicken Burger', 'category' => 'Burgers'],
                ['name' => 'Vegan Burger', 'category' => 'Burgers'],
                ['name' => 'French Fries', 'category' => 'Fries'],
                ['name' => 'Onion Rings', 'category' => 'Snacks'],
                ['name' => 'Milkshake', 'category' => 'Drinks'],
            ],
            'QuickBite' => [
                ['name' => 'Cheese Fries', 'category' => 'Fries'],
                ['name' => 'Bacon Burger', 'category' => 'Burgers'],
                ['name' => 'Chicken Nuggets', 'category' => 'Snacks'],
                ['name' => 'Spicy Chicken Wrap', 'category' => 'Wraps'],
                ['name' => 'Mozzarella Sticks', 'category' => 'Snacks'],
                ['name' => 'Crispy Chicken Salad', 'category' => 'Salads'],
                ['name' => 'Soft Drink', 'category' => 'Drinks'],
            ],
            'Snack Shack' => [
                ['name' => 'BBQ Burger', 'category' => 'Burgers'],
                ['name' => 'Fish Sandwich', 'category' => 'Burgers'],
                ['name' => 'Loaded Nachos', 'category' => 'Snacks'],
                ['name' => 'Fried Chicken Tenders', 'category' => 'Snacks'],
                ['name' => 'Potato Wedges', 'category' => 'Fries'],
                ['name' => 'Lemonade', 'category' => 'Drinks'],
                ['name' => 'Ice Cream Cone', 'category' => 'Desserts'],
            ],
            'Fast Feast' => [
                ['name' => 'Double Cheeseburger', 'category' => 'Burgers'],
                ['name' => 'Chicken Wrap', 'category' => 'Wraps'],
                ['name' => 'Veggie Tacos', 'category' => 'Wraps'],
                ['name' => 'Hot Wings', 'category' => 'Snacks'],
                ['name' => 'French Fries', 'category' => 'Fries'],
                ['name' => 'Fried Pickles', 'category' => 'Snacks'],
                ['name' => 'Apple Pie', 'category' => 'Desserts'],
            ],
            'Burger Corner' => [
                ['name' => 'Classic Cheeseburger', 'category' => 'Burgers'],
                ['name' => 'Crispy Chicken Sandwich', 'category' => 'Burgers'],
                ['name' => 'Spicy Chicken Burger', 'category' => 'Burgers'],
                ['name' => 'Onion Rings', 'category' => 'Snacks'],
                ['name' => 'Chili Fries', 'category' => 'Fries'],
                ['name' => 'Milkshake (Vanilla, Chocolate)', 'category' => 'Drinks'],
                ['name' => 'Fountain Drink', 'category' => 'Drinks'],
            ],
            'Fry & Fly' => [
                ['name' => 'Fish & Chips', 'category' => 'Fries'],
                ['name' => 'Spicy Fries', 'category' => 'Fries'],
                ['name' => 'Popcorn Chicken', 'category' => 'Snacks'],
                ['name' => 'Garlic Parmesan Fries', 'category' => 'Fries'],
                ['name' => 'Mozzarella Sticks', 'category' => 'Snacks'],
                ['name' => 'Coke', 'category' => 'Drinks'],
                ['name' => 'Soft Pretzel', 'category' => 'Snacks'],
            ],
            'Chomp Express' => [
                ['name' => 'Bacon Cheeseburger', 'category' => 'Burgers'],
                ['name' => 'Grilled Chicken Salad', 'category' => 'Salads'],
                ['name' => 'Pulled Pork Sandwich', 'category' => 'Burgers'],
                ['name' => 'Veggie Burger', 'category' => 'Burgers'],
                ['name' => 'Curly Fries', 'category' => 'Fries'],
                ['name' => 'Chicken Wings', 'category' => 'Snacks'],
                ['name' => 'Iced Tea', 'category' => 'Drinks'],
            ],
        ];

        foreach ($restaurants as $restaurant => $records) {
            $resta = Restaurant::where('name', $restaurant)->first();
            $date = $faker->dateTimeThisYear;
            foreach ($records as $record) {
                $category = Category::where('name', $record['category'])->first();
                $data[] = [
                    'restaurant_id' => $resta->id,
                    'category_id' => $category->id,
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
            }
        }

        if (!empty($data)) {
            RestaurantCategory::insert($data);
        }
    }
}
