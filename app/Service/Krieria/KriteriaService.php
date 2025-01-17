<?php

namespace App\Service\Krieria;

use App\Models\Kriteria;
use App\Service\Contract\KriteriaServiceInterface;

class KriteriaService implements KriteriaServiceInterface
{

    public function __construct(private Kriteria $kriteriaModel) {}

    public function GetAllKriteria(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->kriteriaModel->all();
    }

    public function CreateKriteria(array $data) {
        $kriteria = new Kriteria();
        $kriteria->name = $data['name'];
        $kriteria->desc = $data['desc'];
        $kriteria->bobot_id = $data['bobot_id'];
        $kriteria->kategori = $data['kategori'];
        $kriteria->save();

        return $kriteria;
    }

    public function UpdateKriteria(string $id, array $data) {
        $kriteria = $this->kriteriaModel->findOrFail($id);

        // dd($kriteria);
        if(!$kriteria) {
            return false;
        }

        $kriteria->update($data);
        return $kriteria;

    }

    public function DeleteKriteria(string $id) {
        $deletedKriteria = $this->kriteriaModel->findOrFail($id);
        if(!$deletedKriteria) {
            return false;
        }

        $delete = $deletedKriteria->delete();

        return $delete;
    }
}
