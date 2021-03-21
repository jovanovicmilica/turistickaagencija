<?php
    
    require_once "konekcija.php";

    $id=$_GET['id'];

    $dohvatiPutovanje="SELECT * FROM putovanje p INNER JOIN putovanjecena pc on p.idPutovanja=pc.idPutovanje INNER JOIN prevoz pr ON pr.idPrevoz=p.idPrevoz WHERE p.idPutovanja=:id";

    $priprema=$konekcija->prepare($dohvatiPutovanje);
    $priprema->bindParam(":id",$id);

    try{
        $priprema->execute();
        if($priprema->rowCount()==1){
            $putovanje=$priprema->fetch();
        }
        else{
            echo "NEMA VEZE SA SERVEROM";
        }
    }
    catch(PDOException $e){
        echo "DOSLO JE DO GRESKE";
    }

?>