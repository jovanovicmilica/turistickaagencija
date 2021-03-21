<?php

    require_once "konekcija.php"; 

    $upit="SELECT * from putovanje p INNER JOIN putovanjecena pc on p.idPutovanja=pc.idPutovanje";
    try{
        $svaPutovanja=$konekcija->query($upit)->fetchAll();
    }
    catch(PDOException $e){
        $rez="Greska sa serverom";
    }
?>