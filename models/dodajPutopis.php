<?php
    require "konekcija.php";

    $code=200;
    $data="OK";

    
    if(isset($_POST['dugme'])){
        $slika=$_FILES['slika'];
        $naslov=$_POST['naslov'];
        $tekst=$_POST['tekst'];

        $tmpName=$slika['tmp_name'];
        $size=$slika['size'];
        $tip=$slika['type'];
        $name=$slika['name'];
        $naziv=time().$name;///
        $putanja="../assets/images/$naziv";

        $rezultat=move_uploaded_file($tmpName,$putanja);

        $upit="INSERT INTO putopis VALUES (null, :naslov,:tekst,:slika)";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":naslov",$naslov);
        $priprema->bindParam(":tekst",$tekst);
        $priprema->bindParam(":slika",$naziv);

        try{
            $priprema->execute();
            $data="Uspesno ste dodali putopis";
           
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