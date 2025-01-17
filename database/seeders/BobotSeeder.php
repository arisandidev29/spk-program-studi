<?php

namespace Database\Seeders;

use App\Models\Bobot;
use App\Service\Contract\BobotServiceInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(BobotServiceInterface $bobotService): void
    {
        $bobots = [
            [
                'name' => 'sangat penting',
                'nilai' => 50,
            ],
            [
                'name' => 'penting',
                'nilai' => 30,
            ],
            [
                'name' => 'cukup penting',
                'nilai' => 20,
            ],
            [
                'name' => 'kurang penting',
                'nilai' => 10,
            ],
            [
                'name' => 'tidak penting',
                'nilai' => 0,
            ],
        ];

        Bobot::query()->insert($bobots);

        $bobotService->normalizationBobot();
    }
}
