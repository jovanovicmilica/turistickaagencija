<?php 
session_start();
    require_once "konekcija.php";  
    $listaZelja=false;
    if(isset($_SESSION['korisnik'])){
        $idPutovanja=$_GET['id'];
        $korisnik=$_SESSION['korisnik'];
        $id=$korisnik['idKorisnika'];
        $lista="SELECT * FROM listazelja WHERE idKorisnika=:id AND idPutovanja=:idp";
        $priprema=$konekcija->prepare($lista);
        $priprema->bindParam(":id",$id);
        $priprema->bindParam(":idp",$idPutovanja);
        try{
            $priprema->execute();
            if($priprema->rowCount()==1){
                $listaZelja=true;
            }
        }
        catch(PDOException $e){
            $data="Greska";
        }
    }

?>