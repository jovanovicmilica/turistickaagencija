<?php
    include "models/poruke.php";
?>

<main>
    <div id="drzacAdmin">
        <h1>Poruke</h1>
        <table>
            <tr>
                <th>Ime i prezime</th>
                <th>E-mail</th>
                <th>Telefon</th>
                <th>Tema</th>
                <th>Poruka</th>
            </tr>

            <?php
                foreach($poruke as $p):
            ?>
                <tr>
                    <td><?=$p['ime']." ".$p['prezime']?></td>
                    <td><?=$p['email']?></td>
                    <td><?=$p['telefon']?></td>
                    <td><?=$p['tema']?></td>
                    <td><?=$p['poruka']?></td>
                </tr>
            <?php
                endforeach;
            ?>
        </table>
    </div>
</main>