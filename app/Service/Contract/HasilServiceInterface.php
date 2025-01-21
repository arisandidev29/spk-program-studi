<?php
namespace App\Service\Contract;

interface HasilServiceInterface {
    function createHasil($alternative,$vektor) ;
    function GetHasilUser();
    function GetHasilAll();

    function DeleteUserHasil();

    function GetRekomendasi();

    

}



?>