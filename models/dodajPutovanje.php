<?php
    require "konekcija.php";

    $code=200;
    $data="OK";

    
    if(isset($_POST['dugme'])){
        $slika=$_FILES['slika'];
        $naslov=$_POST['naslov'];
        $polazak=$_POST['polazak'];
        $povratak=$_POST['povratak'];
        $tekst=$_POST['tekst'];
        $cena=$_POST['cena'];
        $prevoz=$_POST['prevoz'];

        $tmpName=$slika['tmp_name'];
        $size=$slika['size'];
        $tip=$slika['type'];
        $name=$slika['name'];
        $naziv=time().$name;///
        $putanja="../assets/images/$naziv";

        $rezultat=move_uploaded_file($tmpName,$putanja);

        $upit="INSERT INTO putovanje  VALUES (null,:naziv,:opis,:slika,:prevoz)";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":naziv",$naslov);
        $priprema->bindParam(":opis",$tekst);
        $priprema->bindParam(":slika",$naziv);
        $priprema->bindParam(":prevoz",$prevoz);

        try{
            $priprema->execute();
            $data="Uspesno ste dodali putovanje";
            $id=$konekcija->lastInsertId();
            $upit2="INSERT INTO putovanjecena VALUES (null,:id,:polazak,:povratak,:cena)";
            $priprema2=$konekcija->prepare($upit2);
            $priprema2->bindParam(":id",$id);
            $priprema2->bindParam(":polazak",$polazak);
            $priprema2->bindParam(":povratak",$povratak);
            $priprema2->bindParam(":cena",$cena);
            try{
                $priprema2->execute();
                $data="Uspesno ste dodali putovanje";
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