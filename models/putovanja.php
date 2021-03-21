<?php
    
    require_once "konekcija.php";


    $dohvatiPutovanja="SELECT * from putovanje p INNER JOIN putovanjecena pc on p.idPutovanja=pc.idPutovanje WHERE pc.datumPolaska>CURRENT_DATE ORDER BY pc.datumPolaska LIMIT 3";


    try{
        $putovanje=$konekcija->query($dohvatiPutovanja)->fetchAll();
    }
    catch(PDOException $e){
        echo "DOSLO JE DO GRESKE";
    }

?>