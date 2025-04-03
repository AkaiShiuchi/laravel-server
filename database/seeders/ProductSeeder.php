<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
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
                    'name' => $record['name'],
                    'description' => $this->generateDescription($record['name']),
                    'rating' => rand(1, 5),
                    'delivery_cost' => rand(10, 50),
                    'cooking_time' => rand(10, 30),
                    'ingredients' => $this->generateIngredients(),
                    'offer' => $this->generateOffer(),
                    'serve_on' => now()->addDays(rand(1, 7)),
                    'restaurant_id' => $resta->id,
                    'category_id' => $category->id,
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
            }
        }

        if (!empty($data)) {
            Product::insert($data);
        }
    }

    protected function generateDescription($dishName)
    {
        $descriptions = [
            "A delicious and satisfying choice for anyone who loves $dishName.",
            "$dishName made with the finest ingredients, offering a unique flavor experience.",
            "An irresistible blend of spices and textures, perfect for $dishName lovers.",
            "Freshly prepared $dishName that will leave you craving more.",
            "The perfect combination of flavors, a must-try for all $dishName enthusiasts.",
        ];

        return $descriptions[array_rand($descriptions)];
    }

    protected function generateIngredients()
    {
        $ingredients = [
            'Lettuce', 'Tomato', 'Cheese', 'Chicken', 'Beef', 'Bacon', 'Pickles', 'Mustard', 'Ketchup', 'Onions',
            'Garlic', 'Olives', 'Eggs', 'Lemon', 'Olive Oil', 'Herbs', 'Spices', 'Chili', 'Potatoes', 'Mayo'
        ];

        return implode(', ', array_slice($ingredients, 0, rand(3, 6)));
    }

    protected function generateOffer()
    {
        $offers = [
            '10% off on your first order',
            'Buy 1 get 1 free',
            'Free delivery on orders above $50',
            '50% off on selected items',
            'Combo offer: Fries + Drink for $5',
            'Get a free dessert with any meal',
        ];

        return $offers[array_rand($offers)];
    }
}
