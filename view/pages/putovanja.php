<?php
    
    include "models/svaPutovanja.php";

?>


<main>

    <div class="strana">
        <h1>Putovanja</h1>
    </div>


    <div id="putovanja">

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
    <?php
        $trenutna=(isset($_GET['strana'])? $_GET['strana'] : 1);
        $prethodna=$trenutna-1;
        $sledeca=$trenutna+1;
    ?>
            <div id="stranicenje">
                <?php
                    if($trenutna!=1):
                ?>
                <a href="<?=$_SERVER['PHP_SELF']."?strana=".$prethodna?>">Prethodna</a>
                <?php
                    endif;
                ?>
                <?php
                
                    for($i=0;$i<$brojStrana;$i++):
                        $broj=$i+1
                ?>
                    <a href="<?=$_SERVER['PHP_SELF']."?strana=".$broj?>"><?=$i+1?></a>
                <?php
                    endfor;
                ?>
                <?php
                    if($trenutna!=$brojStrana):
                ?>
                <a href="<?=$_SERVER['PHP_SELF']."?strana=".$sledeca?>">Sledeca</a>
                <?php
                    endif;
                ?>
            </div>


</main>