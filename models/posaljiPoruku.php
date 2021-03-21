<?php

    require_once "konekcija.php";
    $kod=200;
    if(isset($_POST["dugme"])){
        $data="TU";
        $ime=$_POST['ime'];
        $prezime=$_POST['prezime'];
        $email=$_POST['email'];
        $telefon=$_POST['telefon'];
        $tema=$_POST['tema'];
        $poruka=$_POST['poruka'];

        $regExIme="/^[A-Z][a-z]{2,29}$/";
        $regExPrezime="/^[A-Z][a-z]{2,39}$/";
        $regExEmail="/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/";
        $regExTelefon="/^06\d{8}$/";
        $regExTema="/^[\w\s\d]+$/";
        
    $greska=0;
    if(!preg_match($regExIme,$ime)){
        $greska++;
        $data="Ime mora poceti velikim slovom i ima 30 karaktera najvise";
    }
    if(!preg_match($regExPrezime,$prezime)){
        $greska++;
        $data="Prezime mora poceti velikim slovom i ima 40 karaktera najvise";
    }
    if(!preg_match($regExEmail,$email)){
        $greska++;
        $data="E-mail format: ivana.panic.176.16@ict.edu.rs ili ivana@gmail.com";
    }
    if(!preg_match($regExTelefon,$telefon)){
        $greska++;
        $data="Telefon mora biti u formatu 06******** (8 cifara) umesto zvezdica";
    }
    if(!preg_match($regExTema,$tema)){
        $greska++;
        $data="Morate upisati temu";
    }
    if(count($poruka)<10){
        $greska++;
        $data="Poruka mora imati bar 10 reči";
    }
    if($greska==0){
        $poruka=implode($poruka," ");
        $insert="INSERT INTO poruke VALUES(null,:ime,:prezime,:mail,:telefon, :tema,:poruka)";
        $priprema=$konekcija->prepare($insert);
        $priprema->bindParam(":ime",$ime);
        $priprema->bindParam(":prezime",$prezime);
        $priprema->bindParam(":mail",$email);
        $priprema->bindParam(":telefon",$telefon);
        $priprema->bindParam(":tema",$tema);
        $priprema->bindParam(":poruka",$poruka);
        try{
            $priprema->execute();
            $data="Uspesno ste poslali poruku";
            $kod=201;
        }
        catch(PDOException $e){
            $data="Greska sa serverom";
            $kod=500;
        }
    }
    }
    else{
        $kod=404;
        $data="Nemate pristup stranici";
    }

echo json_encode($data);
http_response_code($kod);
?>