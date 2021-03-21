<?php
session_start();
    require_once "konekcija.php";

    $data="";
    if(isset($_POST['dugme'])){
        if(isset($_SESSION['korisnik'])){
            $idAnkete=$_POST['anketa'];
            $odgovor=$_POST['izbor'];
            $korisnik=$_SESSION['korisnik'];
            $idKorisnik=$korisnik['idKorisnika'];

            $upit="INSERT INTO odgovorianketa VALUES (NULL,:odg,:idAnketa,:idKorisnik)";
            $priprema=$konekcija->prepare($upit);
            $priprema->bindParam(":odg",$odgovor);
            $priprema->bindParam(":idAnketa",$idAnkete);
            $priprema->bindParam(":idKorisnik",$idKorisnik);
            try{
                $priprema->execute();
                $code=201;
                $data="Uspešno ste glasali";
            }
            catch(PDOException $e){
                $code=500;
                $data="Greška sa serverom";
            }
        }
        else{
            $code=200;
            $data="Morate se ulogovati da biste glasali";
        }
    }
    else{
        $code=404;
        $data="Nemate pristup";
    }

    
echo json_encode($data);
http_response_code($code);

?>