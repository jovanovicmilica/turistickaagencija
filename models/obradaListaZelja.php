<?php 
session_start();
    require_once "konekcija.php";
    if(isset($_POST['dugmeLista'])){
        if(isset($_SESSION['korisnik'])){
            $idPutovanja=$_POST['idPutovanja'];
            $korisnik=$_SESSION['korisnik'];
            $id=$korisnik['idKorisnika'];
            $lista="SELECT * FROM listazelja WHERE idKorisnika=:id AND idPutovanja=:idp";
            $priprema=$konekcija->prepare($lista);
            $priprema->bindParam(":id",$id);
            $priprema->bindParam(":idp",$idPutovanja);
            try{
                $priprema->execute();
                if($priprema->rowCount()==1){
                    ///vec je u listi,brisem
                    $upit2="DELETE FROM listazelja WHERE idKorisnika=:id AND idPutovanja=:idPu";
                    $data="delete";
                }
                else{
                    ///nije u listi,dodajem
                    $upit2="INSERT INTO listazelja VALUES (null,:id,:idPu)";
                    $data="insert";
                }
                $priprema2=$konekcija->prepare($upit2);
                $priprema2->bindParam(":id",$id);
                $priprema2->bindParam(":idPu",$idPutovanja);
                try{
                    $priprema2->execute();
                    $code=200;
                }
                catch(PDOException $e){
                    $data="Greska sa serverom";
                    $code=500;
                }
            }
            catch(PDOException $e){
                $data="Greska sa serverom";
                $code=500;
            }
        }
        else{
            $data="Morate se ulogovati";
            $code=200;
        }
    }  
    else{
        $code=404;
        $data="Nemate pristup";
    } 
    

    echo json_encode($data);
    http_response_code($code);
?>