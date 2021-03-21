<?php 
session_start();
    require_once "konekcija.php";
    if(isset($_POST['dugmeLista'])){
        if(isset($_SESSION['korisnik'])){
            $idPutovanja=$_POST['idPutovanja'];
            $korisnik=$_SESSION['korisnik'];
            $id=$korisnik['idKorisnika'];
            $upit="DELETE FROM listazelja WHERE idPutovanja=:id AND idKorisnika=:idKor";
            $priprema=$konekcija->prepare($upit);
            $priprema->bindParam(":id",$idPutovanja);
            $priprema->bindParam(":idKor",$id);
            try{
                $priprema->execute();
                $code=200;
                $data="Obrisali ste iz liste zelja";
            }
            catch(PDOException $e){
                $code=500;
                $data="Greska sa serverom";
            }
        }
        else{
            $data="Nemate pristup";
            $code=404;
        }
    }  
    else{
        $code=404;
        $data="Nemate pristup";
    } 
    

    echo json_encode($data);
    http_response_code($code);
?>