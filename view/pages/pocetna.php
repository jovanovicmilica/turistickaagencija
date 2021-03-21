<?php

    include "models/putovanja.php";
    include "models/putopisi.php";
    include "models/anketa.php";
?>

<div class="slika pocetna">

</div>

<main>

    <div id="putovanja">
        <div class="naslov">
            <h1>Predstojeća putovanja</h1>
        </div>

        <?php
            foreach($putovanje as $p):
        ?>
            <div class="putovanje">
                <div>
                    <p>Polazak</p>
                    <span><?=$p['datumPolaska']?></span>
                </div>
                <div>
                    <p>Povratak</p>
                    <span><?=$p['datumPovratka']?></span>
                </div>
                <div>
                    <p>Dana</p>
                    <span><?=(strtotime($p['datumPovratka'])-strtotime($p['datumPolaska']))/60/60/24?></span>
                </div>
                <div>
                    <img src="assets/images/<?=$p['slika']?>" alt="">
                </div>
                <div>
                    <h3><?=$p['naziv']?></h3>
                </div>
                <div>
                    <p>Cena</p>
                    <span><?=$p['cena']?> EUR</span>
                    <div class="link">
                        <a href="putovanje.php?id=<?=$p['idPutovanja']?>">Pogledaj</a>
                    </div>
                </div>
            </div>
        <?php
            endforeach;
        ?>

    </div>

    <div id="putopisi">
        <h2>Najnoviji putopisi</h2>

        <div id="drzacPutopisi">

        <?php
            foreach($putopis as $pu):
        ?>
            <div class="putopis">
                <div>
                    <img src="assets/images/<?=$pu['slika']?>" alt="">
                </div>
                <h3><?=$pu['naslov']?></h3>
                <p><?=$pu['tekst']?>...</p>
                <a href="putopis.php?id=<?=$pu['idPutopis']?>">Nastavite sa čitanjem</a>
            </div>
        <?php
            endforeach;
        ?>


        </div>

    </div>
    <div id="anketa">
        <h2>Anketa</h2>

    <?php
        if($glasao):

    ?>
        <p>Vec ste popunili ovu anketu.</p>
    <?php
    else:
            if($rez->rowCount()==1):
    ?>
    <br>
        <h3><?=$anketa['pitanje']?></h3>
        <br>
        <form action="">
            <input type="hidden" id="anketaId" value="<?=$anketa['idAnkete']?>">

    <?php
        foreach($odgovori as $odg):
    ?>
        <input type="radio" value="<?=$odg['idOdgovora']?>" name="anketa"><?=$odg['tekstOdgovora']?>
    <?php
        endforeach;
    ?>
    <br>
    <br>
        <input type="button" id="glasajAnketa" value="Pošalji">
        </form>
        <p id="anketaTekst"></p>
    <?php
        else:
    ?>
        <h3>Trenutno nema ankete.</h3>
    <?php
        endif;
        
        endif;
    ?>
    </div>

</main>