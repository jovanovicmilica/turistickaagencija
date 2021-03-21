<?php
    require_once "konekcija.php";

    $upit="SELECT * FROM meni";


    try{  
        $rezultat=$konekcija->query($upit)->fetchAll();
        $meni=$rezultat;
        $code=200;
    }
    catch(PDOException $e){
        $code=500;
        $meni="Izvinjavamo se, doslo je do greske";
    }
    


?>