<?php

namespace Database\Seeders;

use App\Models\Fridge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FridgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fridges = [
            [
                'name' => 'Test fridge',
                'users_id' => 1,
            ],
        ];

        Fridge::insert($fridges);
    }
}
