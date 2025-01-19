<?php
namespace App\Service\Contract;

interface JawabanSeriviceInterface {
    function GetAllJawaban();
    function CreateJawaban($data);

    function UpdateJawaban($id,$data);

    function DeleteJawaban($id):bool;
}



?>