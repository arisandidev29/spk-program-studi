<?php

namespace Tests\Feature;

use App\Models\Alternative;
use App\Models\Jawaban;
use App\Models\Kriteria;
use App\Models\User;
use App\Service\Contract\JawabanSeriviceInterface;
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

use function PHPUnit\Framework\assertNotNull;

class JawabanServiceTest extends TestCase
{
    protected $jawabanService;
    public function setUp(): void
    {
        parent::setUp();
        $this->jawabanService = App::make(JawabanSeriviceInterface::class);
    }
    /**
     * A basic feature test example.
     */
    public function testService()
    {
        self::assertNotNull($this->jawabanService);
    }


    public function testCreateJawaban()
    {
        $this->seed([
            UserSeeder::class,
            AlternativeSeeder::class,
            BobotSeeder::class,
            KriteriaSeeder::class,
        ]);

        $user = User::where('name', 'arisandi')->first();

        Auth::login($user);

        $kriteria = Kriteria::where('name', 'Suka Ketik')->first();
        $alternative = Alternative::where('name', 'like', 'sistem%')->first();

        $data = [
            'nilai' => 50,
            'alternative_id' => $alternative->id,
            'kriteria_id' => $kriteria->id
        ];

        $jawaban = $this->jawabanService->CreateJawaban($data);

        dump($jawaban);

        self::assertEquals(1, count(Jawaban::all()));
    }

    public function testGetAllJawaban()
    {
        $this->seed([
            UserSeeder::class,
            AlternativeSeeder::class,
            BobotSeeder::class,
            KriteriaSeeder::class,
            JawabanSeeder::class
        ]);

        $user = User::where('name', 'arisandi')->first();

        Auth::login($user);

        $jawaban = $this->jawabanService->getAllJawaban();

        self:
        assertNotNull($jawaban);

        foreach ($jawaban as $j) {
            dump($j->kriteria->name . " : " . $j->nilai);
        }
    }

    public function testupdateJawaban()
    {
        $this->seed([
            UserSeeder::class,
            AlternativeSeeder::class,
            BobotSeeder::class,
            KriteriaSeeder::class,
        ]);
        $user = User::where('name', 'arisandi')->first();

        Auth::login($user);

        $kriteria = Kriteria::where('name', 'Suka Ketik')->first();
        $alternative = Alternative::where('name', 'like', 'sistem%')->first();

        $data = [
            'nilai' => 50,
            'alternative_id' => $alternative->id,
            'kriteria_id' => $kriteria->id
        ];

        $jawaban = $this->jawabanService->CreateJawaban($data);

        // dd($jawaban);

        $updatedKriteria = Kriteria::where('name','like','%it')->get()->first();
        // dd($updatedKriteria);

        $UpdateData = [
            'kriteria_id' => $updatedKriteria->id
        ];

        $updateJawaban = $this->jawabanService->UpdateJawaban($jawaban->id,$UpdateData);

        dump($updateJawaban);

        self::assertEquals('minat pada it', $updateJawaban->kriteria->name);
    }

    public function testDeleteJawaban() {
        $this->seed([
            UserSeeder::class,
            AlternativeSeeder::class,
            BobotSeeder::class,
            KriteriaSeeder::class,
        ]);
        $user = User::where('name', 'arisandi')->first();

        Auth::login($user);

        $kriteria = Kriteria::where('name', 'Suka Ketik')->first();
        $alternative = Alternative::where('name', 'like', 'sistem%')->first();

        $data = [
            'nilai' => 50,
            'alternative_id' => $alternative->id,
            'kriteria_id' => $kriteria->id
        ];

        $jawaban = $this->jawabanService->CreateJawaban($data);


        self::assertTrue($this->jawabanService->DeleteJawaban($jawaban->id));
        self::assertEquals(0,count(Jawaban::all()));
    }
}
