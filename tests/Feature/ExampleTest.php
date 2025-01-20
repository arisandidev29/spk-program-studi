<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Bobot;
use App\Models\Jawaban;
use App\Models\Kriteria;
use App\Models\User;
use Database\Seeders\AlternativeSeeder;
use Database\Seeders\BobotSeeder;
use Database\Seeders\JawabanSeeder;
use Database\Seeders\KriteriaSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        DB::delete('delete from bobots');
        DB::delete('delete from kriterias');
        $this->seed([BobotSeeder::class, KriteriaSeeder::class]);

        dump(Kriteria::all());
    }

    public function testRealtionship()
    {
        $this->seed([
            UserSeeder::class,
            AlternativeSeeder::class,
            BobotSeeder::class,
            KriteriaSeeder::class,
            JawabanSeeder::class
        ]);
        // dump(Jawaban::all());
        $resultt = Jawaban::whereHas('user', function ($user) {
            $user->where('name', 'arisandi');
        })->get();

        $result2 = Jawaban::with(['user' => function ($user) {
            $user->where('name', 'arisandi');
        }])->get();

        // dump($result2->toArray(),$resultt->toArray());
        // self::assertEquals(count($resultt),count($result2));


        $jawaban = new Jawaban();

        dump($jawaban->with(['user'])->user()->where('name', 'arisandi')->get());
    }

    public function testVector(): void
    {
        $this->seed([BobotSeeder::class]);

        $bobot = Bobot::all();
        $newBobot = $bobot->map(function ($item) {
            return $item->nilai * $item->normalisasi;
        })->reduce(fn($item) => $item * $item );

        dump($newBobot);
    }
}
