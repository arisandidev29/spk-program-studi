<?php

namespace App\Service\Contract;

use Illuminate\Database\Eloquent\Collection;

interface VektorServiceInterface
{
    function createVector($alternative_id);
    function GetAllVector(): Collection;
    function UpdateVector($id, $data): Collection;
    function DeleteVector($id): bool;
}
