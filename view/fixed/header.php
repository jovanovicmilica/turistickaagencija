<?php
    require_once "models/meni.php";
?>

<header>
    <div id="kontakt">
        <div class="kontakt">
            <i class="fas fa-phone"></i>
            <span>011500500</span>
            <i class="fas fa-envelope"></i>
            <span>palma@gmail.com</span>
        </div>
        <div class="kontakt">
        <?php
            if(isset($_SESSION['korisnik'])):
                $korisnik=$_SESSION['korisnik'];
                $uloga=$korisnik['idUloge'];
                if($uloga==1):
        ?>  
                <a href="admin.php"><i class="fas fa-users-cog"></i> Admin panel</a>

                <?php
                    endif;
                ?>
            <a href="listaZelja.php" id="listaZelja"><i class="far fa-heart"></i> Lista želja</a>
            <a href="#" id="odjava"><i class="fas fa-sign-out-alt"></i> Odjavi se</a>
        <?php
            else:
        ?>
            <a href="#" id="nalog"><i class="fas fa-user"></i> Nalog</a>
        <?php
            endif;
        ?>
        </div>
    </div>
    <nav>
        <div id="logo">
            <a href="index.php">
                <img src="assets/images/logo.png" alt="Logo slika">
            </a>
        </div>
        <ul>
        <?php
            foreach($meni as $m):
        ?>

            <li>
                <a href="<?=$m['link']?>"><?=$m['naziv']?></a>
            </li>

        <?php
            endforeach;
        ?>
        </ul>   
    </nav>
</header>
<div id="modal">
    <div id="linkoviModal">
        <a href="#" id="logovanje" class="aktivno">Uloguj se</a>
        <a href="#" id="registracija" >Registruj se</a>
        <a href="#" id="close"><i class="fas fa-times"></i></a>
        <div id="logovanjeForma">
            <h2>Uloguj se</h2>
            <form action="">
                <p>E-mail:</p>
                <input type="text" id="emailLog">
                <p>Lozinka:</p>
                <input type="password" id="lozinkaLog">
                <br>
                <input type="button" value="Uloguj se" id="btnLog">
            </form>
            <p id="logovanjeStatus"></p>
        </div>
        <div id="registracijaForma">
            <h2>Registruj se</h2>
            <form action="">
                <p>Ime:</p>
                <input type="text" id="ime">
                <p>Prezime:</p>
                <input type="text" id="prezime">
                <p>E-mail:</p>
                <input type="text" id="email">
                <p>Lozinka:</p>
                <input type="password" id="lozinka">
                <p>Ponovi lozinku:</p>
                <input type="password" id="lozinkaPonovi">
                <br>
                <input type="button" value="Registruj se" id="btnReg">
                <p id="porukaIme"></p>
                <p id="porukaPrezime"></p>
                <p id="porukaEmail"></p>
                <p id="porukaLozinka"></p>
                <p id="porukaLozinkaPonovi"></p>
                <p id="poruka"></p>
            </form>
        </div>
    </div>
</div>