<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Bobot;
use App\Models\Kriteria;
use Database\Seeders\BobotSeeder;
use Database\Seeders\KriteriaSeeder;
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
        $this->seed([BobotSeeder::class,KriteriaSeeder::class]);

        dump( Kriteria::all());
    }
}
