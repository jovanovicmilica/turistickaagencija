<?php

    require_once "konekcija.php";

    $data="";
    $upit="SELECT * FROM poruke";

    
    try{  
        $poruke=$konekcija->query($upit)->fetchAll();
    }
    catch(PDOException $e){
        $poruke="Greska sa serverom";
    }

?>