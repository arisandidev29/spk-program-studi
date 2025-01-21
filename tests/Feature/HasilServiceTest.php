<?php

namespace Tests\Feature;

use App\Models\Alternative;
use App\Models\Hasil;
use App\Models\Jawaban;
use App\Models\User;
use App\Service\Contract\HasilServiceInterface;
use App\Service\Contract\VektorServiceInterface;
use Database\Seeders\AlternativeSeeder;
use Database\Seeders\BobotSeeder;
use Database\Seeders\JawabanSeeder;
use Database\Seeders\KriteriaSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Tests\TestCase;

class HasilServiceTest extends TestCase
{

    protected $HasilSerivice;
    protected $vektorService;

    public function setUp(): void
    {
        parent::setUp();

        $this->HasilSerivice = App::make(HasilServiceInterface::class);
        $this->vektorService = App::make(VektorServiceInterface::class);
        $this->seed([
            UserSeeder::class,
            AlternativeSeeder::class,
            BobotSeeder::class,
            KriteriaSeeder::class,
            JawabanSeeder::class
    
        ]);
    }

    public function testService()

    {
        self::assertNotNull($this->HasilSerivice);
    }

    public function InsertHasil($user)
    {

        $alternative = Alternative::where('name', 'like', '%sistem%')->first();

        $alternative1 = Alternative::where('name', 'like', '%manajemen%')->first();

        $alternative2 = Alternative::where('name', 'like', '%komputerisasi%')->first();


        $jawaban = Jawaban::where('alternative_id', $alternative->id)->get();



        FacadesAuth::login($user);

        $vektor = $this->vektorService->createVector($alternative->id);
        $vektor2 = $this->vektorService->createVector($alternative1->id);
        $vektor3 = $this->vektorService->createVector($alternative2->id);

        $hasil1 = $this->HasilSerivice->createHasil($alternative->id, $vektor);

        $hasil2 = $this->HasilSerivice->createHasil($alternative1->id, $vektor2);

        $hasil2 = $this->HasilSerivice->createHasil($alternative2->id, $vektor3);
    }

    public function testCreateHasil()
    {

        $user = User::where('name','arisandi')->first();
        $this->InsertHasil($user);
        
        dump(Hasil::where('user_id', FacadesAuth::id())->orderBy('nilai_preferensi', 'desc')->get()->toArray());
        
        dump(Hasil::all()->toArray());
    }
    
    public function testGetHasilUser()
    {
        $user = User::where('name','arisandi')->first();
        $this->InsertHasil($user);
        
        
        self::assertEquals(3, count($this->HasilSerivice->GetHasilUser()));
    }
    
    public function testGetHasilRekomendasi() {

        $user2 = User::where('name','sandi')->first();

        $this->InsertHasil($user2);

        $rekomendasi = $this->HasilSerivice->GetRekomendasi();
        
        $alternative = Alternative::all()->map(
            fn($item) => $item->name
        )->toArray();


        self::assertTrue(in_array($rekomendasi, $alternative));

        dump($rekomendasi);
    }
    
    public function testGetHasilAll() {
        
        $user = User::where('name','arisandi')->first();
        
        $user2 = User::where('name','sandi')->first();
    
        $this->InsertHasil($user);
        $this->InsertHasil($user2);
        
        $all = $this->HasilSerivice->GetHasilAll();
        
    }
    
    public function testDeleteUserHasil() {
        $user = User::where('name','arisandi')->first();
        $user2 = User::where('name','sandi')->first();

        $this->InsertHasil($user);
        $this->InsertHasil($user2);


        FacadesAuth::login($user);
        $this->HasilSerivice->DeleteUserHasil();

        dump($this->HasilSerivice->GetHasilAll()->toArray());
    }
}
