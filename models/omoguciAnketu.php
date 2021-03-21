<?php
    require_once "konekcija.php";

    $data="";
    $kod=200;
    if(isset($_POST['dugme'])){
        //onemoguci
        $upit="UPDATE anketa SET aktivna = 0";
    }
    if(isset($_POST['dugme2'])){
        //omoguci
        $upit="UPDATE anketa SET aktivna = 1";
    }

    try{
        $konekcija->query($upit);

    }
    catch(PDOException $e){
        $kod=500;
        $data="Greska sa serverom";
    }




    
echo json_encode($data);
http_response_code($kod);
?>