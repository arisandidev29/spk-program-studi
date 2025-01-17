<?php
namespace App\Service\Contract;

interface KriteriaServiceInterface {
    function GetAllKriteria();

    function CreateKriteria();

    function UpdateKriteria();

    function DeleteKriteria();
}

?>