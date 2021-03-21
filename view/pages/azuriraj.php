<?php
    require "models/prevoz.php";
    require "models/dohavatiProzivod.php";
?>

<main>
    <div id="drzacAdmin">
        <h1>Ažuriraj</h1>

        <div class="forma">
        <form action="" enctype="multipart/form-data">
                <input type="text" id="naslovUpdate" value="<?=$putovanje['naziv']?>" placeholder="Naslov">
                <input type="hidden" id="id" value="<?=$putovanje['idPutovanja']?>">
                <textarea  id="tekstUpdate" placeholder="O putovanju"><?=$putovanje['opis']?></textarea>
                <input type="text" id="cenaUpdate" placeholder="Cena" value="<?=$putovanje['cena']?>">
                <br>
                Datum polaska: <input type="date" id="polazakUpdate" value="<?=$putovanje['datumPolaska']?>">
                <br>
                Datum povratka: <input type="date" id="povratakUpdate" value="<?=$putovanje['datumPovratka']?>">
                <br>
                Nacin prevoza: <select id="prevozUpdate">
                    <?php
                        foreach($prevoz as $p):
                    ?>
                        <option
                        <?php
                            if($putovanje['idPrevoz']==$p['idPrevoz']):
                        ?>
                            selected="true"
                        <?php
                            endif;
                        ?>
                        value="<?=$p['idPrevoz']?>"><?=$p['nazivPrevoz']?></option>
                    <?php
                        endforeach;
                    ?>
                </select>
                <input type="button" id="updatePutovanje" value="Ažuriraj putovanje">
                <p id="porukaUpdatePutovanje"></p>
            </form>
        </div>
    </div>
</main>