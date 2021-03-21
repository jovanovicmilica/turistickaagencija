<?php
    require_once "konekcija.php";   

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $upit="SELECT * FROM putovanje p INNER JOIN putovanjecena pc on p.idPutovanja=pc.idPutovanje INNER JOIN prevoz pr ON pr.idPrevoz=p.idPrevoz WHERE p.idPutovanja=:id";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":id",$id);
        try{
            $priprema->execute();
            $putovanje=$priprema->fetch();
        }
        catch(PDOExcepion $e){
            echo "GRESKA SA SERVEROM";
        }
    }
    else{
        echo "NEMATE PRISTUP";
    }
?>