<?php

namespace Database\Seeders;

use App\Models\Alternative;
use App\Models\Jawaban;
use App\Models\Kriteria;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JawabanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteria = Kriteria::all();
        $user = User::all();
        $alternative = Alternative::all();

        for ($i = 0; $i <= 10; $i++) {
            $jawaban = [
             
                    'nilai' => random_int(0, 100),
                    'kriteria_id' => $kriteria->random()->id,
                    'user_id' => $user->random()->id,
                    'alternative_id' => $alternative->random()->id
             
            ];

            // dd($jawaban);

            Jawaban::create($jawaban);
        }
    }
}
