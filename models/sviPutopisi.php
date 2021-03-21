<?php
    
    require_once "konekcija.php";


    $dohvatiPutopise="SELECT idPutopis,naslov,slika,LPAD(tekst,155,' ') AS tekst FROM putopis";


    try{
        $putopis=$konekcija->query($dohvatiPutopise)->fetchAll();
    }
    catch(PDOException $e){
        echo "DOSLO JE DO GRESKE";
    }

?>