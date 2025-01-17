<?php
namespace App\Service\Contract;

use App\Models\Kriteria;
use Illuminate\Database\Eloquent\Collection;

interface KriteriaServiceInterface {
    function GetAllKriteria() : Collection;

    function CreateKriteria(array $data);

    function UpdateKriteria(string $id , array $data);

    function DeleteKriteria(string $id);
}

?>