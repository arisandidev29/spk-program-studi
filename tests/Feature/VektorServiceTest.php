<?php

namespace Tests\Feature;

use App\Models\Alternative;
use App\Models\Jawaban;
use App\Models\User;
use App\Models\Vektor;
use App\Service\Contract\VektorServiceInterface;
use Database\Seeders\AlternativeSeeder;
use Database\Seeders\BobotSeeder;
use Database\Seeders\JawabanSeeder;
use Database\Seeders\KriteriaSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class VektorServiceTest extends TestCase
{
    protected VektorServiceInterface $vektorService;

    public function setUp(): void
    {
        parent::setUp();

        $this->vektorService = App::make(VektorServiceInterface::class);
        $this->seed([
            UserSeeder::class,
            AlternativeSeeder::class,
            BobotSeeder::class,
            KriteriaSeeder::class,
            JawabanSeeder::class
        ]);
    }

    public function test_Service(): void
    {
        self::assertNotNull($this->vektorService);

    }

    public function testCreateVector()
    {



        $alternative = Alternative::where('name', 'like', '%sistem%')->first();


        $jawaban = Jawaban::where('alternative_id', $alternative->id)->get();


        $user = User::where('name', 'arisandi')->first();

        Auth::login($user);

        $vektor = $this->vektorService->createVector($alternative->id);

        self::assertEquals(1, count(Vektor::all()));
    }

    public function testGetAllVector()
    {
        $alternative = Alternative::where('name', 'like', 'sistem%')->first();

        $alternative2 = Alternative::where('name', 'like', '%manajemen%')->first();

        // dd($alternative);


        $jawaban1 = Jawaban::where('alternative_id', $alternative->id)->get();

        $jawaban2 = Jawaban::where('alternative_id', $alternative2->id)->get();


        $user = User::where('name', 'arisandi')->first();

        Auth::login($user);

        $vektor1 = $this->vektorService->createVector($alternative->id);

        $vektor2 = $this->vektorService->createVector($alternative2->id);


        dd($this->vektorService->GetAllVector());
    }
}
