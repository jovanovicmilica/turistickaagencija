<?php
    include "models/prikaziListu.php"; 
?>

<main>

<div class="strana duzina">
    <h1>Lista želja</h1>

    <?php
        if($greska):
    ?>
    <h2><?=$greska?></h2>
    <?php
        elseif($prazno):
    ?>
    <h2>Lista zelja je prazna</h2>
    <?php
        else:
    ?>
    <table>
    <?php
        foreach($rez as $r):
    ?>
        <tr>
            <td><?=$r['naziv']?></td>
            <td><img src="assets/images/<?=$r['slika']?>" alt="<?=$r['naziv']?>"></td>
            <td><a href="#" class="listaZeljaBrisi" data-id="<?=$r['idPutovanja']?>"><i class="far fa-trash-alt"></i></a></td>
        </tr>
    <?php
        endforeach;
    ?>
    </table>
    <?php
        endif;
    ?>
</div>
</main>