<?php

    include "view/fixed/head.php";
    
    include "view/fixed/header.php";

    if(isset($_SESSION['korisnik'])){
        include "view/pages/listaZeljaPrikaz.php";
    }
    else{
        include "view/pages/error.php";
    }


    include "view/fixed/footer.php";
?>