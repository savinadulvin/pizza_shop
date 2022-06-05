<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PizzaModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizzaModels = [
            [
                'name' => 'Original',
                'description' => 'Small',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            [
                'name' => 'Original',
                'description' => 'Medium',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            [
                'name' => 'Original',
                'description' => 'Large',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            [
                'name' => 'Gimme the Meat',
                'description' => 'Small',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            [
                'name' => 'Gimme the Meat',
                'description' => 'Medium',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            [
                'name' => 'Gimme the Meat',
                'description' => 'Large',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            [
                'name' => 'Veggie Delight',
                'description' => 'Small',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            [
                'name' => 'Veggie Delight',
                'description' => 'Medium',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            [
                'name' => 'Veggie Delight',
                'description' => 'Large',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            [
                'name' => 'Make Mine Hot',
                'description' => 'Small',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            [
                'name' => 'Make Mine Hot',
                'description' => 'Medium',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            [
                'name' => 'Make Mine Hot',
                'description' => 'Large',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            [
                'name' => 'Create Your Own (not a named pizza)',
                'description' => 'Small',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            [
                'name' => 'Create Your Own (not a named pizza)',
                'description' => 'Medium',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            [
                'name' => 'Create Your Own (not a named pizza)',
                'description' => 'Large',
                'is_active' => true,
                'manufacturer_id' => 1,
            ],
            
        ];
        foreach ($pizzaModels as $pizzaModel) {
            \App\Models\PizzaModel::create($pizzaModel);
        }
    }
}
