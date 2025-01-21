<?php
namespace App\Service\Hasil;

use App\Models\Hasil;
use App\Models\Vektor;
use App\Service\Contract\HasilServiceInterface;
use Illuminate\Support\Facades\Auth;

class HasilService implements HasilServiceInterface {
    public function __construct(protected Hasil $hasilModel){}
    public function createHasil($alternative,$vektor) {
        $totalVektor = Vektor::sum('nilai_s');

        $nilaiPreferensi = $vektor->nilai_s / $totalVektor;

        $hasil = new Hasil();
        $hasil->nilai_preferensi = $nilaiPreferensi;
        $hasil->user_id = Auth::id();
        $hasil->alternative_id = $alternative;
        $hasil->vektor_id = $vektor->id;

        $hasil->save();
        $this->rankingHasil();

        return $hasil;

    }

    public function GetHasilUser() {
        $UserHasil = $this->hasilModel
                            ->where('user_id',Auth::id())
                            ->orderBy('nilai_preferensi','DESC')
                            ->get();


        return $UserHasil;
    }

    public function GetRekomendasi() {
        $hasil = $this->GetHasilUser()->first();
        return $hasil->alternative->name; 
    }


    public function GetHasilAll(){
        $allHasil = $this->hasilModel
                            ->with('user')
                            ->get();

        $grup = $allHasil->groupBy(function($item) {
            return $item->user->name;
        });

        $sortByPreferensi = $grup->map(function ($item) {
            return $item->sortByDesc('nilai_preferensi');
        });

        return $sortByPreferensi;
    }


    public function DeleteUserHasil(){
        $hasil =  $this->hasilModel
                        ->where('user_id',Auth::id())
                        ->get();

        $HasilId = $hasil->map(fn($item) => $item->id);

        $this->hasilModel->whereIn('id',$HasilId)->delete();

    }

    public function rankingHasil() {
        $AllHasil = $this->hasilModel
                        ->where('user_id',Auth::id())
                        ->orderBy('nilai_preferensi','DESC')->get(); 

        $AllHasil->each(function ($item, $key) {
            $item->rangking = $key + 1;
            $item->save();
        });
    }


}


?>