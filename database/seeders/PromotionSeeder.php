<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $promotions = [
            [
                'name' => 'Buy one get one free',
                'code' => 'BOGOF',
                'type' => 'number_of_items_validation',
                'value' => 2,
                'price_type' => 'percentage',
                'price_value' => '50',
                'description' => 'Get 50% off when you buy 2 items',
                'is_active' => 1,
            ],
            [
                'name' => 'Three for Two',
                'code' => '3FOR2',
                'type' => 'number_of_items_validation',
                'value' => 3,
                'price_type' => 'percentage',
                'price_value' => '33',
                'description' => 'Buy three medium pizzas, get £33 off',
                'is_active' => 1,
            ],
            [
                'name' => 'Family Feast',
                'code' => 'B21000OFF',
                'type' => 'number_of_items_validation',
                'value' => 4,
                'price_type' => 'fixed',
                'price_value' => '30',
                'description' => 'When you buy 4 pizzas, get £30 off',
                'is_active' => 1,
            ],
            [
                'name' => 'Two Large',
                'code' => '2LARGE',
                'type' => 'number_of_items_validation',
                'value' => 2,
                'price_type' => 'fixed',
                'price_value' => '25',
                'description' => 'When you buy 2 large pizzas, get £25 off',
                'is_active' => 1,
            ],
            [
                'name' => 'Two Medium',
                'code' => '2MEDIUM',
                'type' => 'number_of_items_validation',
                'value' => 2,
                'price_type' => 'fixed',
                'price_value' => '18',
                'description' => 'When you buy 2 medium pizzas, get £18 off',
                'is_active' => 1,
            ],
            [
                'name' => 'Two Small',
                'code' => '2SMALL',
                'type' => 'number_of_items_validation',
                'value' => 2,
                'price_type' => 'fixed',
                'price_value' => '12',
                'description' => 'When you buy 2 small pizzas, get £12 off',
                'is_active' => 1,
            ],
        ];

        foreach ($promotions as $promotion) {
            \App\Models\Promotion::create($promotion);
        }
    }
}
