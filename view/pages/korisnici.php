<?php
    include "models/korisnici.php";
?>

<main>
    <div id="drzacAdmin">
        <h1>Korisnici</h1>

        <table>
            <tr>
                <th>E-mail</th>
                <th>Ime</th>
                <th>Prezime</th>
            </tr>

            <?php
                foreach($korisnici as $k):
            ?>
                <tr>
                    <td><?=$k['email']?></td>
                    <td><?=$k['ime']?></td>
                    <td><?=$k['prezime']?></td>
                </tr>
            <?php
                endforeach;
            ?>
        </table>
    </div>
</main>