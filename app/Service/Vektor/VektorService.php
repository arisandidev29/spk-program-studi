<?php

namespace App\Service\Vektor;

use App\Models\Vektor;
use App\Service\Contract\JawabanSeriviceInterface;
use App\Service\Contract\VektorServiceInterface;
use Illuminate\Support\Facades\Auth;

class VektorService implements VektorServiceInterface
{

    public function __construct(
        protected Vektor $modelVektor,
        protected JawabanSeriviceInterface $jawabanService
        ){}

    public function createVector($alternative_id)
    {
        $jawaban = $this->jawabanService->GetAllJawaban()->where('alternative_id',$alternative_id);

        $vektor_s = $jawaban->map(function ($item) {
            return round(pow($item->nilai, $item->kriteria->bobot->normalisasi), 2);
        })->reduce(fn($carry, $item) => $carry * $item, 1);


        $vektor = new Vektor();
        $vektor->user_id = Auth::id();
        $vektor->nilai_s = round($vektor_s,2);
        $vektor->alternative_id = $alternative_id;

        $vektor->save();

        return $vektor;
    }

    public function GetAllVector(): \Illuminate\Database\Eloquent\Collection {

        $allVektor = $this->modelVektor
        ->with('alternative')
        ->where('user_id',Auth::id())
        ->get();
        
        $gruped = $allVektor->groupBy(function($item) {
            return $item->alternative->name;
        });



        return $gruped; 
    }

    public function UpdateVector($id, $data): \Illuminate\Database\Eloquent\Collection {
        $vektor = $this->modelVektor->findOrFail($id);

        $vektor->update($data);
        return $vektor;

    }


    public function DeleteVector($id) : bool{
        $vecktor = $this->modelVektor->findOrFail($id);
        $delete = $vecktor->delete();
        return $delete;
    }
}
