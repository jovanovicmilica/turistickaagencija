<?php
    
    require_once "konekcija.php";

    $id=$_GET['id'];

    $dohvatiPutovanje="SELECT * FROM putopis WHERE idPutopis=:id";

    $priprema=$konekcija->prepare($dohvatiPutovanje);
    $priprema->bindParam(":id",$id);

    try{
        $priprema->execute();
        if($priprema->rowCount()==1){
            $putopis=$priprema->fetch();
        }
        else{
            echo "NEMA VEZE SA SERVEROM";
        }
    }
    catch(PDOException $e){
        echo "DOSLO JE DO GRESKE";
    }

?>