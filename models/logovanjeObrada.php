<?php

session_start();
    require_once "konekcija.php";

    $data="";
    if(isset($_POST['dugme'])){
        //$data="ok";

        $mail=$_POST['mail'];
        $pass=$_POST['pass'];
    
        $regEmail="/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/";
        $regPass="/^.{8,50}$/";

        $greske=[];

        if(!preg_match($regEmail,$mail)){
            array_push($greske,"E-mail format: ivana.panic.176.16@ict.edu.rs ili ivana@gmail.com");
        }
        if(!preg_match($regPass,$pass) && strlen($pass)<8){
            array_push($greske,"Lozinka mora imati barem 8 karaktera");
        }

        if(count($greske)==0){
            $aktivan=1;
            $daLiPostojiKorisnik="SELECT * FROM korisnici K WHERE email=:email AND aktivan=:aktivan";
            $priprema=$konekcija->prepare($daLiPostojiKorisnik);
            $priprema->bindParam(":email",$mail);
            $priprema->bindParam(":aktivan",$aktivan);
            try{
                $priprema->execute();
                if($priprema->rowCount()==1){
                    //$data="OK";
                    $upit="SELECT * FROM korisnici k INNER JOIN uloga u ON k.idUloge=u.idUloge WHERE email=:email AND pass=:pass";
                    $pass=md5($pass);
                    $priprema2=$konekcija->prepare($upit);
                    $priprema2->bindParam(":email",$mail);
                    $priprema2->bindParam(":pass",$pass);
                    try{
                        $priprema2->execute();
                        $code=200;
                        if($priprema2->rowCount()==1){
                            $korisnik=$priprema2->fetch();
                            $_SESSION['korisnik']=$korisnik;
                            $code=201;
                            $data=201;
                        }
                        else{
                            $data="Lozinka nije ispravna";
                        }
                    }
                    catch(PDOException $e){
                        $code=500;
                        $data="Greška sa serverom";
                    }
                    $code=200;
                }
                else{
                    $code=200;
                    $data="Korisnik sa zadatom adresom nije pronadjen ili niste aktivirali nalog";
                }
            }
            catch(PDOException $e){
                $code=500;
                $data="Greška sa serverom";
            }
        }
        else{
            $data=$greske;
            $code=404;
        }


        $code=200;
    }
    else{
        $data="Nemate pristup.";
        $code=404;
    }


    
echo json_encode($data);
http_response_code($code);

?>