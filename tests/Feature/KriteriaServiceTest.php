<?php

namespace Tests\Feature;

use App\Models\Bobot;
use App\Models\Kriteria;
use App\Service\Contract\KriteriaServiceInterface;
use Database\Seeders\BobotSeeder;
use Database\Seeders\KriteriaSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class KriteriaServiceTest extends TestCase
{

    protected $kriteriaService;
    public function setUp(): void
    {
        parent::setUp();
        DB::delete('delete from kriterias');
        DB::delete('delete from bobots');
        $this->kriteriaService = App::make(KriteriaServiceInterface::class);
    }

    public function testService()
    {
        self::assertNotNull($this->kriteriaService);
    }

    public function testCreateKriteria() {
        $this->seed(BobotSeeder::class );
        $bobotId = Bobot::first()->id;
        $kriteria = [
            'name' => 'suka pada komputer ?',
            'desc' => 'ketertarikan kepada komputer',
            'bobot_id' => $bobotId,
            'kategori' => 'benefit'
        ];
        
        $this->kriteriaService->CreateKriteria($kriteria);
        
        self::assertEquals(1,Kriteria::count());
        dump(Kriteria::all());
        
    }
    public function testGetAllKriteria() {
        
        $this->seed([BobotSeeder::class, KriteriaSeeder::class] );
        
        self::assertEquals(3,count($this->kriteriaService->GetAllKriteria()));
        
        dump($this->kriteriaService->GetAllKriteria());
    }
    
    public function testUpdateKriteria() {
        $this->seed(BobotSeeder::class );
        $bobotId = Bobot::first()->id;
        $kriteria = [
            'name' => 'suka pada komputer ?',
            'desc' => 'ketertarikan kepada komputer',
            'bobot_id' => $bobotId,
            'kategori' => 'benefit'
        ];
        
        $kriteria = $this->kriteriaService->CreateKriteria($kriteria);

        $data = [
            'desc' => 'i like tech',
            'kategori' => 'cost'
        ];

        $kriteria = $this->kriteriaService->UpdateKriteria($kriteria->id,$data);

        self::assertEquals('i like tech', Kriteria::where('name','suka pada komputer ?')->first()->desc);
        
    }

    public function testDeleteKriteria() {
        $this->seed([BobotSeeder::class, KriteriaSeeder::class]);
        
        self::assertTrue($this->kriteriaService->DeleteKriteria(Kriteria::first()->id));

        dump($this->kriteriaService->GetAllKriteria());

    }
}

