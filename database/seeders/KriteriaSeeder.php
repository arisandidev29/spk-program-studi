<?php

namespace Database\Seeders;

use App\Models\Bobot;
use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $bobot = Bobot::all();
        $kriteria =   [
            [
                'name' => 'minat pada it',
                'desc' => 'tes',
                'bobot_id' => $bobot->random()->first()->id,
                'kategori' => 'benefit'
            ],
            [
                'name' => 'Suka Ketik',
                'desc' => 'tes',
                'bobot_id' => $bobot->random()->first()->id,
                'kategori' => 'benefit'
            ],
            [
                'name' => 'Suka Teknologi',
                'desc' => 'tes',
                'bobot_id' => $bobot->random()->first()->id,
                'kategori' => 'benefit'
            ],
        ];   

        Kriteria::query()->insert($kriteria);
    }
}
