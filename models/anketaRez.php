<?php

    require_once "konekcija.php";

        $upit="SELECT o.tekstOdgovora,COUNT(o.idOdgovora) AS ukupno FROM odgovori o INNER JOIN odgovorianketa oa ON o.idOdgovora=oa.idOdgovora GROUP BY o.tekstOdgovora";
        try{
            $anketa=$konekcija->query($upit)->fetchAll();
            $rezultat=$anketa;
            $code=200;
        }
        catch(PDOException $e){
            $code=500;
            $data="Server error";
        }


?>