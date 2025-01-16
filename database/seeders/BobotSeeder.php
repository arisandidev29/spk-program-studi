<?php

namespace Database\Seeders;

use App\Models\Bobot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bobots = [
            [
                'name' => 'sangat penting',
                'nilai' => 50,
                'normalisasi' => 0.5 
            ],
            [
                'name' => 'penting',
                'nilai' => 30,
                'normalisasi' => 0.3 
            ],
            [
                'name' => 'cukup penting',
                'nilai' => 20,
                'normalisasi' => 0.2 
            ],
            [
                'name' => 'kurang penting',
                'nilai' => 10,
                'normalisasi' => 0.1 
            ],
            [
                'name' => 'tidak penting',
                'nilai' => 0,
                'normalisasi' => 0 
            ],
        ];

        Bobot::query()->insert($bobots);
    }
}
