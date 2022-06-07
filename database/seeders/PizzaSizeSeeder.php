<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PizzaSize;

class PizzaSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizza_sizes = [
            [
                'name' => 'Small'
            ],
            [
                'name' => 'Medium'
            ],
            [
                'name' => 'Large'
            ]
        ];

        foreach($pizza_sizes as $size){
            (new PizzaSize())->create($size);
        }
    }
}
