<?php

    require_once "konekcija.php";

    $data="";
    $upit="SELECT * FROM korisnici";

    
    try{  
        $korisnici=$konekcija->query($upit)->fetchAll();
    }
    catch(PDOException $e){
        $korisnici="Greska sa serverom";
    }

?>