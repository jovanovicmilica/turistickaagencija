<?php
    require "konekcija.php";

    $upit="SELECT * FROM prevoz";
    try{
        $prevoz=$konekcija->query($upit)->fetchAll();
    }
    catch(PDOException $e){
        $prevoz="Doslo je do greske";
    }
?>