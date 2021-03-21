<?php
    require_once "konekcija.php";


    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $upit="SELECT * FROM putopis WHERE idPutopis=:id";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":id",$id);
        try{
            $priprema->execute();
            $putopis=$priprema->fetch();
        }
        catch(PDOExeption $e){
            echo "Greska sa serverom";
        }
    }
    else{
        echo "Nemate pristup";
    }


?>