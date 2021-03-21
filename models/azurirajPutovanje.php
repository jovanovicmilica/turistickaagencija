<?php
    
    require "konekcija.php";
    $code=200;
    $data="";
    
    if(isset($_POST['dugme'])){
        $naslov=$_POST['naslov'];
        $polazak=$_POST['polazak'];
        $povratak=$_POST['povratak'];
        $tekst=$_POST['tekst'];
        $cena=$_POST['cena'];
        $prevoz=$_POST['prevoz'];
        $id=$_POST['id'];

        $upit="UPDATE putovanje SET naziv=:naziv,opis=:opis,idPrevoz=:idPrevoz WHERE idPutovanja=:id";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":naziv",$naslov);
        $priprema->bindParam(":opis",$tekst);
        $priprema->bindParam(":idPrevoz",$prevoz);
        $priprema->bindParam(":id",$id);

        try{
            $priprema->execute();
            $upit2="UPDATE putovanjecena SET datumPolaska=:polazak,datumPovratka=:povratak,cena=:cena WHERE idPutovanje=:id";
            $priprema2=$konekcija->prepare($upit2);
            $priprema2->bindParam(":polazak",$polazak);
            $priprema2->bindParam(":povratak",$povratak);
            $priprema2->bindParam(":cena",$cena);
            $priprema2->bindParam(":id",$id);
            try{
                $priprema2->execute();
                $data="Uspesno ste azurirali putovanje";
            }
            catch(PDOException $e){
                $code=500;
                $data="Greska sa serverom";
            }

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