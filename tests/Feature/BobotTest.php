<?php

namespace Tests\Feature;

use App\Models\Bobot;
use Database\Seeders\BobotSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BobotTest extends TestCase
{
    public function setUp(): void {
        parent::setUp();
        DB::delete('delete from kriterias');
        DB::delete('delete from bobots');
    }
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->seed(BobotSeeder::class);

        Bobot::create([
            'name' => 'engga penting sih',
            'nilai' => 10
        ]);

        $totalBobot = Bobot::sum('nilai');
        Bobot::query()->update([
            // 'nilai' => 20,
            'normalisasi' => DB::raw("Round(nilai / $totalBobot, 2 )")
        ]);
    }
}
