<?php
    
    require_once "konekcija.php";

    $strana=1;
    $limit=5;
    $offset=0;

    $dohvatiPutovanja="SELECT * from putovanje p INNER JOIN putovanjecena pc on p.idPutovanja=pc.idPutovanje WHERE pc.datumPolaska>CURRENT_DATE";


    try{
        $sve=$konekcija->query($dohvatiPutovanja);
        $ukupno=$sve->rowCount();
        if(isset($_GET['strana'])){
            $offset=($_GET['strana']-1)*$limit;
        }
        
        $brojStrana=ceil($ukupno/$limit);

        $dohvati="SELECT * from putovanje p INNER JOIN putovanjecena pc on p.idPutovanja=pc.idPutovanje WHERE pc.datumPolaska>CURRENT_DATE LIMIT :limitVrednost OFFSET :offsetVrednost";
        $priprema=$konekcija->prepare($dohvati);
        $priprema->bindParam(":limitVrednost",$limit,PDO::PARAM_INT);
        $priprema->bindParam(":offsetVrednost",$offset,PDO::PARAM_INT);
        try{
            $priprema->execute();
            $putovanje=$priprema->fetchAll();
        }
        catch(PDOException $e){
            echo "DOSLO JE DO GRESKE";
        }
    }
    catch(PDOException $e){
        echo "DOSLO JE DO GRESKE";
    }

?>