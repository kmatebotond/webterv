<?php
  session_start();
  if (isset($_SESSION["keresztnev"]) && isset($_SESSION["email"])) {
    echo "Szia " . $_SESSION["keresztnev"] . "!";
  }
?>

<!DOCTYPE html>
<html lang="hu">
  <head>
    <title>Kezdőoldal</title>
    <link rel="icon" href="../img/logo.png">
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="../css/style.css">
  </head>

  <body>
    <div class="top">
      <header>
        <div id="cim" >
          <img class="logo" id="flogo" src="../img/logo.png" alt="Logó">
          <h1>Webáruház</h1>
        </div>
        <h4>Olcsóbb, mint gondolnád!</h4>
      </header>
    </div>
      <nav id="navbar">
          <div class="sticky">
            <a class="active bal" href="index.php">Kezdőoldal</a>
            <a class="bal" href="profil.php">Profil</a>
            <a class="bal"  href="rolunk.php">Rólunk</a>

            <div class="jobb">
              <a  class="jobb" href="regisztracio.php">Regisztráció</a>
              <?php
                echo "<a class=\"jobb\" href=\"";
                if (isset($_SESSION["keresztnev"]) && isset($_SESSION["email"])) {
                  echo "kijelentkezes.php\">Kijelentkezés";
                } else {
                  echo "bejelentkezes.php\">Bejelentkezés";
                }
                echo "</a>";
              ?>
            </div>
          </div>
      </nav>
    
    <main>
      <section>
        <h3 class="cimke"><b>Telefonok</b></h3>
        
        <a class="termek" href="termek.php">
          <img class="tkep" src="../img/telefon.png" alt="Telefon"/>
          <p class="tnev">Telefon</p>
        </a>
        <a class="termek" href="termek.php">
          <img class="tkep" src="../img/telefon.png" alt="Telefon"/>
          <p class="tnev">Telefon</p>
        </a>
      </section>
      
      <section>
        <h3 class="cimke"><b>Fülhallgatók</b></h3>
        
        <a class="termek" href="termek.php">
          <img class="tkep" src="../img/fulhallgato.png" alt="Fülhallgató"/>
          <p class="tnev">Fülhallgató</p>
        </a>
        <a class="termek" href="termek.php">
          <img class="tkep" src="../img/fulhallgato.png" alt="Fülhallgató"/>
          <p class="tnev">Fülhallgató</p>
        </a>
      </section>
      
      <section>
        <h3 class="cimke"><b>Egerek</b></h3>
        
        <a class="termek" href="termek.php">
          <img class="tkep" src="../img/eger.png" alt="Egér"/>
          <p class="tnev">Egér</p>
        </a>
        <a class="termek" href="termek.php">
          <img class="tkep" src="../img/eger.png" alt="Egér"/>
          <p class="tnev">Egér</p>
        </a>
      </section>
      
      
      <section>
        <h3 class="cimke"><b>Billentyűzetek</b></h3>
        
        <a class="termek" href="termek.php">
          <img class="tkep" src="../img/billentyuzet.png" alt="Billentyűzet"/>
          <p class="tnev">Billentyűzet</p>
        </a>
        <a class="termek" href="termek.php">
          <img class="tkep" src="../img/billentyuzet.png" alt="Billentyűzet"/>
          <p class="tnev">Billentyűzet</p>
        </a>
      </section>
    </main>
      
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
    </footer>
  </body>
</html>