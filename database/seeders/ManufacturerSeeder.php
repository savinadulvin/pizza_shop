<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manufacturers = [
            [
                'name' => 'Pizza Shop',
                'description' => 'Pizza Shop',
                'is_active' => true,
            ],
            
        ];

        foreach ($manufacturers as $manufacturer) {
            \App\Models\Manufacturer::create($manufacturer);
        }
    }
}
