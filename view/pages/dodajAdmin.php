<?php
    require "models/prevoz.php";
?>

<main>
    <div id="drzacAdmin">
        <h1>Dodaj</h1>
<div class="formaAdmin">
        <div class="forma">
                <h2>Dodaj putovanje</h2>
            <form action="" enctype="multipart/form-data">
                <input type="text" id="naslov" placeholder="Naslov">
                <textarea  id="tekst" placeholder="O putovanju"></textarea>
                <input type="text" id="cena" placeholder="Cena">
                <br>
                Datum polaska: <input type="date" id="polazak">
                <br>
                Datum povratka: <input type="date" id="povratak">
                <br>
                Nacin prevoza: <select id="prevoz">
                    <?php
                        foreach($prevoz as $p):
                    ?>
                        <option value="<?=$p['idPrevoz']?>"><?=$p['nazivPrevoz']?></option>
                    <?php
                        endforeach;
                    ?>
                </select>
                <input type="file" id="slika">
                <input type="button" id="dodajPutovanje" value="Dodaj putovanje">
                <p id="porukaInsertPutovanje"></p>
            </form>
        </div>

        <div class="forma" enctype="multipart/form-data">
                <h2>Dodaj putopis</h2>
            <form action="">
                <input type="text" id="naslovPutopis" placeholder="Naslov">
                <textarea  id="tekstPutopis" placeholder="Tekst"></textarea>
                <input type="file" id="slikaPutopis">
                <input type="button" id="dodajPutopis" value="Dodaj putopis">
                <p id="formaDodajPutopis"></p>
            </form>
        </div>
    </div>
    </div>
</main>