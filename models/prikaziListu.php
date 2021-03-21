<?php 
    require_once "konekcija.php";  
    $greska=false;
    $prazno=false;
    if(isset($_SESSION['korisnik'])){
        $korisnik=$_SESSION['korisnik'];
        $id=$korisnik['idKorisnika'];
        $lista="SELECT * FROM listazelja l INNER JOIN putovanje p on l.idPutovanja=p.idPutovanja WHERE l.idKorisnika=:id";
        $priprema=$konekcija->prepare($lista);
        $priprema->bindParam(":id",$id);
        try{
            $priprema->execute();
            if($priprema->rowCount()!=0){
                $rez=$priprema->fetchAll();
            }
            else{
                $prazno=true;
            }
        }
        catch(PDOException $e){
            $greska="Greska sa serverom";
        }
    }

?>