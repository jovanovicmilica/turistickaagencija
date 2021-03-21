<?php

    require_once "konekcija.php";   

    if(isset($_GET['kod'])){
        $kod=$_GET['kod'];
    
    $upit="SELECT * FROM korisnici WHERE aktivacionikod=:kod";

    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":kod",$kod);
    try{
        $priprema->execute();
        if($priprema->rowCount()==1){
            $korisnik=$priprema->fetch();
            $ime=$korisnik['ime'];
            $aktivan=1;
            $upit2="UPDATE korisnici SET aktivan=:akt WHERE aktivacioniKod=:kod";
            $priprema2=$konekcija->prepare($upit2);
            $priprema2->bindParam(":akt",$aktivan);
            $priprema2->bindParam(":kod",$kod);
            try{
                $priprema2->execute();
                $data="Aktivirali ste nalog!";
            }
            catch(PDOException $e){
                $data="Greska sa serverom";;
            }
        }
        else{
            $data="Pogresan kod";
        }
    }
    catch(PDOException $e){
        $data="Greska sa serverom";
    }
    }
    else{
        $data="Nemate pristup stranici";
    }
    

?>