<?php
    
    include "models/sviPutopisi.php";

?>


<main>

    <div class="strana">
        <h1>Putopisi</h1>
    </div>


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
                <p><?=$pu['tekst']?>...</p>
                <a href="putopis.php?id=<?=$pu['idPutopis']?>">Nastavite sa čitanjem</a>
            </div>
        <?php
            endforeach;
        ?>


        </div>

    </div>

</main>