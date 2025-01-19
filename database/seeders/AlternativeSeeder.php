<?php

namespace Database\Seeders;

use App\Models\Alternative;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlternativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'sistem informasi (s1)',
                'desc' => 'program studi untuk sistem informasi'
            ],
            [
                'name' => 'manajemen informatika (S3)',
                'desc' => 'program studi untuk manajemen informatika'
            ],
            [
                'name' => 'komputerisasi akuntansi (s3)',
                'desc' => 'program studi untuk komputeriasi akuntasi'
            ],

        ];

        Alternative::insert($data);

    }
}
