<?php
    
    include "models/jednoPutovanje.php";
    require_once "models/listaZelja.php";

?>


<main>

    <div id="putovanje">

    <?php
        if(isset($putovanje)):
    ?>

    <div class='divPutovanje'> 
        <img src="assets/images/<?=$putovanje['slika']?>" alt="">
    
    </div>
    <div class='divPutovanje'>
        <h1><?=$putovanje['naziv']?></h1>
        <?php
            $tekst=explode('.',$putovanje['opis']);
            foreach($tekst as $t):
        ?>
            <p><?=$t?></p>
        <?php
            endforeach;
        ?>
        <a href="#" class="listaZelja 
            <?php
                if($listaZelja):
            ?>
                crveno
            <?php
                endif;
            
            ?>" data-id="<?=$putovanje['idPutovanja']?>"><i class="far fa-heart"></i> 
            <?php
                if($listaZelja):
            ?>
                Nalazi se u Vašoj listi želja

            <?php
                else:
            ?>
                Dodaj u listu želja
            <?php
                endif;
            ?>
            </a>
            <p id="wlist"></p>
    </div>

            <div class="naslov">
                <h2>Informacije o putovanju</h2>
            </div>
            <div id="putovanjeDodatak">
                    <p><span>Cena:</span> <?=$putovanje['cena']?> EUR</p>
                    <p><span>Datum polaska:</span> <?=$putovanje['datumPolaska']?></p>
                    <p><span>Datum povratka:</span> <?=$putovanje['datumPovratka']?></p>
                    <p><span>Broj dana:</span> <?=(strtotime($putovanje['datumPovratka'])-strtotime($putovanje['datumPolaska']))/60/60/24?></p>
                    <p><span>Nacin prevoza:</span> <?=$putovanje['nazivPrevoz']?></p>
            </div>
            <?php
        else:
        ?>
            <h1>Ne postoji izabrano putovanje</h1>
        <?php
            endif;
        ?>
    </div>
    

</main>