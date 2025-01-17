<?php

namespace App\Service\Bobot;

use App\Models\Bobot;
use App\Service\Contract\BobotServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class BobotService implements BobotServiceInterface
{
    protected $bobotModel;

    public function __construct(Bobot $bobot)
    {
        $this->bobotModel = $bobot;
    }

    public function hell() {
        echo "ok";
    }

    public function getAllBobot(): Collection 
    {
        return $this->bobotModel->all();
    }

    public function createBobot(string $name, int $nilai): Bobot
    {
        $bobot = new Bobot();
        $bobot->name = $name;
        $bobot->nilai = $nilai;
        $bobot->save();

        $this->normalizationBobot();
        
        return $bobot;
    }
    
    public function updateBobot(int $id, int $nilai, string $name): ?Bobot
    {
        $bobot = $this->bobotModel->find($id);
        
        if (!$bobot) {
            return null;
        }
        
        $bobot->name = $name;
        $bobot->nilai = $nilai;
        $bobot->save();
        $this->normalizationBobot();
        
        return $bobot;
    }
    
    public function deleteBobot(int $id): bool
    {
        $bobot = $this->bobotModel->find($id);
        
        if (!$bobot) {
            return false; 
        }

        $delete = $bobot->delete();
        $this->normalizationBobot();
        
        return $delete;
    }


    public function normalizationBobot() {
        $sumBobot = $this->bobotModel->sum('nilai'); 


            $this->bobotModel->query()->update([
                'normalisasi' => DB::raw("Round(nilai / $sumBobot,2)")
            ]);



    }

    public function normalizationNilai(int $nilai): float
    {
        $sumBobot = $this->bobotModel->sum('nilai');

        if ($sumBobot == 0) {
            return 0.0; 
        }

        return round($nilai / $sumBobot, 2);
    }
}
