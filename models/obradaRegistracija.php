<?php

    require_once "konekcija.php";

    $data="";

    if(isset($_POST['dugmeReg'])){
        
        $ime=$_POST['ime'];
        $prezime=$_POST['prezime'];
        $mail=$_POST['email'];
        $pass=$_POST['pass'];
        $passConf=$_POST['passConf'];
        
        $regIme="/^[A-Z][a-z]{2,29}$/";
        $regPrezime="/^[A-Z][a-z]{2,39}$/";
        $regEmail="/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/";
        $regPass="/^.{4,50}$/";
        $greske=[];
        if(!preg_match($regIme,$ime)){
            array_push($greske,"Ime mora poceti velikim slovom i ima najvise 30 slova");
        }
        if(!preg_match($regPrezime,$prezime)){
            array_push($greske,"Prezime mora početi velikim slovom i ima najvise 30 slova");
        }
        if(!preg_match($regEmail,$mail)){
            array_push($greske,"E-mail format: ivana.panic.176.16@ict.edu.rs ili ivana@gmail.com");
        }
        if(!preg_match($regPass,$pass) && strlen($pass)<8){
            array_push($greske,"Lozinka mora imati barem 8 karaktera");
        }
        if($passConf!=$pass){
           array_push($greske,"Lozinke se ne poklapaju");
        }
      
        $mailProvera="SELECT email FROM korisnici WHERE email=:mail";
        $priprema=$konekcija->prepare($mailProvera);
        $priprema->bindParam(":mail",$mail);
        try{
            $priprema->execute();
            $rez=$priprema->fetch();
            if($priprema->rowCount()==1){
                $data="E-mail adresa je zauzeta";
                $code=200;
            }
            else{
                if(count($greske)==0){

                    $insert="INSERT INTO korisnici VALUES(NULL,:ime,:prezime,:mail,:pass,:aktivan,:aktivacionikod,:datum,:iduloge)";
                    $pass=md5($pass);
                    $datum=date("Y-m-d H:i:s");
                    $uloga=2;
                    $aktivan=0;
                    $kod=md5(time().md5($mail));
                    
                    /*mail($mail,"Registracija korisnika","http://127.0.0.1/agencija/aktivacija.php?kod=".$kod);*/
                    $priprema2=$konekcija->prepare($insert);
                    $priprema2->bindParam(":ime",$ime);
                    $priprema2->bindParam(":prezime",$prezime);
                    $priprema2->bindParam(":mail",$mail);
                    $priprema2->bindParam(":pass",$pass);
                    $priprema2->bindParam(":aktivan",$aktivan);
                    $priprema2->bindParam(":aktivacionikod",$kod);
                    $priprema2->bindParam(":datum",$datum);
                    $priprema2->bindParam(":iduloge",$uloga);
                    try{
                        $uspesno=$priprema2->execute();
                        $code=201;
                        $data="Uspesno ste se registrovali, proverite e-mail kako biste aktivirali nalog";
                    }
                    catch(PDOException $e){
                        $code=500;
                        $data="Server error";
                    }
                }
                else{
                    $data=$greske;
                    $code=422;
                }
            }
        }
        catch(PDOException $e){
            $data= "Server error";
            $code=500;
    }
    
    }
    else{
        $code=404;
        $data="Error";
    }

echo json_encode($data);
http_response_code($code);
?>