<?php
    include "models/sviPutopisi.php";
?>
<main>

    <div id="drzacAdmin">
        <h1>Putopisi</h1>
        <div id="putopisi">

        <div id="drzacPutopisi">

        <?php
            foreach($putopis as $pu):
        ?>
            <div class="putopis">
                <div>
                    <img src="assets/images/<?=$pu['slika']?>" alt="">
                </div>
                <h3><?=$pu['naslov']?></h3>
                <a href="azurirajPutopis.php?id=<?=$pu['idPutopis']?>">Ažuriraj </a>
                <a href="#" data-id="<?=$pu['idPutopis']?>" class="obrisiPutopis">Obriši </a>
            </div>
        <?php
            endforeach;
        ?>


        </div>

    </div>
    </div>

</main>