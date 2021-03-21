<?php
    include "models/putovanjaAdmin.php";
?>
<main>
    <div id="drzacAdmin">
        <h1>Putovanja</h1>

        <div>
            <?php
                foreach($svaPutovanja as $s):
            ?>
                <div class="putovanje">
                <div>
                    <p>Polazak</p>
                    <span><?=$s['datumPolaska']?></span>
                </div>
                <div>
                    <p>Povratak</p>
                    <span><?=$s['datumPovratka']?></span>
                </div>
                <div>
                    <p>Dana</p>
                    <span><?=(strtotime($s['datumPovratka'])-strtotime($s['datumPolaska']))/60/60/24?></span>
                </div>
                <div>
                    <img src="assets/images/<?=$s['slika']?>" alt="">
                </div>
                <div>
                    <h3><?=$s['naziv']?></h3>
                </div>
                <div>
                    <p>Cena</p>
                    <span><?=$s['cena']?> EUR</span>
                    <div class="link">
                        <a href="azuriraj.php?id=<?=$s['idPutovanja']?>">Ažuriraj</a>
                        <a href="#" data-id="<?=$s['idPutovanja']?>" class="obrisiPutovanje">Obriši</a>
                    </div>
                </div>
                </div>
            <?php
                endforeach;
            ?>
        </div>
    </div>
</main>