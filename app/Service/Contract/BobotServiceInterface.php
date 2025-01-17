<?php
namespace App\Service\Contract;

use App\Models\Bobot;
use Illuminate\Database\Eloquent\Collection;

interface BobotServiceInterface {
    function GetAllBobot(): Collection;

    function CreateBobot(string $name, int $nilai) :Bobot;

    function UpdateBobot(int $id, int $nilai, string $name) :?Bobot;

    function DeleteBobot(int $id) :bool;

    function normalizationBobot();
    function normalizationNilai(int $nilai) :float;
}


?>