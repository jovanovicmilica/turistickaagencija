<?php
    
    include "models/anketaRez.php";
    include "models/anketa.php";

?>


<main>
    <div id="drzacAdmin">
        <h1>Admin panel</h1>

        <div id="rezAnketa">
            <h2>Rezultati ankete</h2>
            <?php
                $ukupno=0;
                foreach($rezultat as $r){
                    $ukupno+= $r['ukupno'];
                }
            ?>
        <?php
            foreach($rezultat as $r):
        ?>
            <p><?=$r['tekstOdgovora']." ".$r['ukupno']/$ukupno*100?>%</p> 
        <?php
            endforeach;
        ?>
        </div>

        <form action="">

            <input type="button"
                <?php
                    if($rez->rowCount()!=1):
                ?>
                    disabled="true"
                <?php
                    endif;
                ?>
             value="Onemogući anketu" id="onemoguci">
            <input type="button"
            <?php
                    if($rez->rowCount()==1):
                ?>
                    disabled="true"
                <?php
                    endif;
                ?>
             value="Omogući anketu" id="omoguci">
        </form> 
        <p id="porukaAnketa"></p>
    </div>
</main>