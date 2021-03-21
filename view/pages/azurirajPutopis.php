<?php
    require "models/dohvatiPutopis.php";
?>

<main>
    <div id="drzacAdmin">
        <h1>Ažuriraj</h1>
        <div class="forma" enctype="multipart/form-data">
                <h2>Dodaj putopis</h2>
            <form action="">
                <input type="text" id="naslovPutopisUpdate" value="<?=$putopis['naslov']?>" placeholder="Naslov">
                <textarea  id="tekstPutopisUpdate" placeholder="Tekst"><?=$putopis['tekst']?></textarea>
                <input type="button" id="updatePutopis" value="Ažuriraj putopis">
                <input type="hidden" id="id" value="<?=$putopis['idPutopis']?>">
                <p id="formaUpdatePutopis"></p>
            </form>
        </div>
    </div>
</main>