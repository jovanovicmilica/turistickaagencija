<?php
    
    include "models/jedanPutopis.php";

?>

<main>
    <div id="jedanPutopis">
    <?php
        if(isset($putopis)):
    ?>
        <h2><?=$putopis['naslov']?></h2>
        <div>
            <img src="assets/images/<?=$putopis['slika']?>" alt="">
        </div>

        <?php
            $red=explode("\r\n",$putopis['tekst']);
            if(count($red)==10):
        ?>
            <ol>
        <?php

            foreach($red as $r):
        ?>
            <li><?=$r?></li>
        <?php
        
            endforeach;
        ?>
        </ol>
        <?php
            else:
                foreach($red as $r):
        ?>
                <p><?=$r?></p>
        <?php
                endforeach;
            endif;
        ?>

        <?php
            else:
        ?>
            <h1>Ne postoji izabrani putopis</h1>
        <?php
        endif;
        ?>
    </div>
</main>