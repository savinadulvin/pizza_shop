<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 1,
                'name' => 'Original',
                'summary' => 'Small',
                'price' => 8,
                'description' => 'Cheese, tomato sauce',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/1/image.jpg'
            ],
            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 2,
                'name' => 'Original',
                'summary' => 'Medium',
                'price' => 9,
                'description' => 'Cheese, tomato sauce',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/1/image.jpg'
            ],
            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 3,
                'name' => 'Original',
                'summary' => 'Large',
                'price' => 11,
                'description' => 'Cheese, tomato sauce',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/1/image.jpg'
            ],

            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 4,
                'name' => 'Gimme the Meat',
                'summary' => 'Small',
                'price' => 11,
                'description' => 'Pepperoni, ham, chicken, minced beef, sausage, bacon',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/2/image.jpg'
            ],
            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 5,
                'name' => 'Gimme the Meat',
                'summary' => 'Medium',
                'price' => 14.50,
                'description' => 'Pepperoni, ham, chicken, minced beef, sausage, bacon',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/2/image.jpg'
            ],
            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 6,
                'name' => 'Gimme the Meat',
                'summary' => 'Large',
                'price' => 16.50,
                'description' => 'Pepperoni, ham, chicken, minced beef, sausage, bacon',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/2/image.jpg'
            ],

            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 7,
                'name' => 'Veggie Delight',
                'summary' => 'Small',
                'price' => 10,
                'description' => 'Onions, green peppers, mushrooms, sweetcorn',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/3/image.jpg'
            ],
            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 8,
                'name' => 'Veggie Delight',
                'summary' => 'Medium',
                'price' => 13,
                'description' => 'Onions, green peppers, mushrooms, sweetcorn',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/3/image.jpg'
            ],
            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 9,
                'name' => 'Veggie Delight',
                'summary' => 'Large',
                'price' => 15,
                'description' => 'Onions, green peppers, mushrooms, sweetcorn',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/3/image.jpg'
            ],
            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 10,
                'name' => 'Make Mine Hot',
                'summary' => 'Small',
                'price' => 11,
                'description' => 'Chicken, onions, green peppers, jalapeno peppers',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/4/image.jpg'
            ],
            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 11,
                'name' => 'Make Mine Hot',
                'summary' => 'Medium',
                'price' => 13,
                'description' => 'Chicken, onions, green peppers, jalapeno peppers',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/4/image.jpg'
            ],
            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 12,
                'name' => 'Make Mine Hot',
                'summary' => 'Large',
                'price' => 15,
                'description' => 'Chicken, onions, green peppers, jalapeno peppers',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/4/image.jpg'
            ],
            
            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 13,
                'name' => 'Create Your Own (not a named pizza)',
                'summary' => 'Small',
                'price' => 8,
                'description' => 'Create a pizza for your own preference',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/5/image.jpg'
            ],
            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 14,
                'name' => 'Create Your Own (not a named pizza)',
                'summary' => 'Medium',
                'price' => 9,
                'description' => 'Create a pizza for your own preference',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/5/image.jpg'
            ],
            [
                'manufacturer_id' => 1,
                'pizza_model_id' => 15,
                'name' => 'Create Your Own (not a named pizza)',
                'summary' => 'Large',
                'price' => 11,
                'description' => 'Create a pizza for your own preference',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'products/5/image.jpg'
            ],
            
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}