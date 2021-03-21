<?php
    require "konekcija.php";

    $code=200;
    $data="";
    if(isset($_POST['dugme'])){
        $id=$_POST['id'];
        $delete="DELETE FROM putopis WHERE idPutopis=:id";
        $priprema=$konekcija->prepare($delete);
        $priprema->bindParam(":id",$id);
        try{
            $priprema->execute();
            $data="Uspesno obrisan";
        }
        catch(PDOException $e){
            $code=500;
            $data="Greska sa serverom";
        }
    }
    else{
        $code=404;
        $data="Nemate pristup";
    }

    
    echo json_encode($data);
    http_response_code($code);
?>