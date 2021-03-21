<?php
    require_once "konekcija.php";

    $code=200;
    $data="";

    if(isset($_POST['dugme'])){
        $naslov=$_POST['naslov'];
        $tekst=$_POST['tekst'];
        $id=$_POST['id'];
        $upit="UPDATE `putopis` SET naslov=:naslov,tekst=:tekst WHERE idPutopis=:id";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":tekst",$tekst);
        $priprema->bindParam(":naslov",$naslov);
        $priprema->bindParam(":id",$id);
        try{
            $priprema->execute();
            $data="Uspesno ste azurirali proizvod";
            $kod=200;
        }
        catch(PDOException $e){
            $data="Greska sa serverom";
            $kod=500;
        }
    }
    else{
        $data="Nemate prisup";
        $kod=404;
    }


    echo json_encode($data);
    http_response_code($kod);
?>