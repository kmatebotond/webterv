<?php
  session_start();
  if (isset($_SESSION["keresztnev"]) && isset($_SESSION["email"])) {
    echo "Szia " . $_SESSION["keresztnev"] . "!";
    
    if (isset($_POST["termek_nev"])) {
      $db = new SQLite3("../db/db.db");
      $statement = $db->prepare("INSERT INTO Rendelesek (email, termek_nev) VALUES (:email, :termek_nev)");
      $statement->bindValue(":email", $_SESSION["email"], SQLITE3_TEXT);
      $statement->bindValue(":termek_nev", $_POST["termek_nev"], SQLITE3_TEXT);
      $statement->execute();
    }
  } elseif(isset($_POST["termek_nev"])) {
    header("Location: bejelentkezes.php");
  }
?>

<!DOCTYPE html>
<html lang="hu">
  <head>
    <title>Termék</title>
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
    <aside>
        <p><b>Kijelző:</b> 6,2", 1080 x 2400</p>
        <p><b>Processzor:</b> Exynos 2100 (5 nm) </p>
        <p><b>Tárhely:</b> 128 GB</p>
        <p><b>Egyéb:</b> GPS, NFC, 4G (LTE), 5G, UWB, USB C</p>
    </aside>
      
      <div style="text-align: center; overflow: hidden; padding: 30px;">
        <h2>Samsung Galaxy S21</h2><br>
        <img class="tkep" id="trmk" src="../img/galaxys21.png" alt="Samsung Galaxy S21"/><br>
        <video controls width="480">
          <source src="../vid/iphone_12_ad.mp4" type="video/mp4"/>
        </video>
        <div style="text-align: left;">
          <p id="termek-leiras">
            A 6,2 hüvelykes Galaxy S21 telefonban szinte biztos, hogy megtalálod kedvenc okostelefon-funkcióid.
           <br>
            Ez a méret ideális a barátokkal való kapcsolattartáshoz, új szenvedélyek felfedezéséhez, élőzéshez és kedvenc műsoraid, filmjeid nézéséhez is.
          <br>
          A legsimább görgetőképernyőnk szuper sima 120 Hz-cel – a hüvelykujjad hálás lesz.
          <br>A frissítési gyakoriságot optimalizálva kisimítja a hírfolyamot, és gyors érintési reakcióidőket biztosít Játék módban.
          <br> Tökéletes a főfőnök legyőzésére.

          </p>
        </div>

        <form action="galaxys21.php" method="POST">
          <input type="hidden" name="termek_nev" value="Samsung Galaxy S21">
          <input class="vasarlas" type="submit" value="Vásárlás"/>
        </form>
      </div>
    </main>
    
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
    </footer>
  </body>
</html>