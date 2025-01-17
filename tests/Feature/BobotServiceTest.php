<?php

namespace Tests\Feature;

use App\Models\Bobot;
use App\Service\Contract\BobotServiceInterface;
use Database\Seeders\BobotSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BobotServiceTest extends TestCase
{
    protected $bobotService;
    public function setUp(): void {
        parent::setUp();
        DB::delete('delete from bobots');
        $this->bobotService = App::make(BobotServiceInterface::class);
    }
    
    public function testCreateBobot() {
        $this->bobotService->createBobot('lumayan',60);
        $this->assertEquals(1, Bobot::count());
    }

    public function testGetAllBobot() {
        $this->seed(BobotSeeder::class);
        $this->bobotService->normalizationBobot();

        dump($this->bobotService->getAllBobot()->toArray());
        $this->assertEquals(5, Bobot::count());
    }
    
    public function testUpdateBobot() {
        $this->seed(BobotSeeder::class);
        $this->bobotService->normalizationBobot();
        
        $bobotId = Bobot::first()->id;
        $bobot = $this->bobotService->updateBobot($bobotId,30,'very important');
        
        self::assertEquals(30,Bobot::first()->nilai);
        self::assertEquals('very important',Bobot::first()->name);
        
    }
    
    public function testDeleteBobot() {
        $this->seed(BobotSeeder::class);
        $this->bobotService->normalizationBobot();
        dump($this->bobotService->getAllBobot()->toArray());
        $bobotId = Bobot::first()->id;
        
        $this->bobotService->deleteBobot($bobotId);
        self::assertEquals(4,Bobot::count());
        dump($this->bobotService->getAllBobot()->toArray());

        
    }
}
