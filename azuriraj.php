<?php

    require_once "view/fixed/head.php";

    include "view/pages/admin.php";

    if(isset($_SESSION['korisnik'])){
        $korisnik=$_SESSION['korisnik'];
        $uloga=$korisnik['idUloge'];
        if($uloga==1){
            include "view/pages/azuriraj.php";
        }
        else{
            include "view/pages/error.php";
        }
    }
    else{
        include "view/pages/error.php";
    }

    include "view/fixed/footer.php";
?>