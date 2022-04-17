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
        <p><b>Kijelző:</b> 5,4", 2340 × 1080</p>
        <p><b>Processzor:</b> 6 magos Apple A14 Bionic processzor</p>
        <p><b>Tárhely:</b> 64 GB</p>
        <p><b>Egyéb:</b> GPS, Glonass, NFC, 4G (LTE), 5G, UWB, Lightning port</p>
    </aside>
      
      <div style="text-align: center; overflow: hidden; padding: 30px;">
        <h2>Apple iPhone 13</h2><br>
        <img class="tkep" id="trmk" src="../img/iphone13.png" alt="Apple iPhone 13"/><br>
        <video controls width="480">
          <source src="../vid/iphone13.mp4" type="video/mp4"/>
        </video>
        <div style="text-align: left;">
          <p id="termek-leiras">
            Akár 120 Hz-es adaptív frissítési gyakoriságot biztosító ProMotion technológia<br>
            HDR‑kijelző<br>
            True Tone technológia<br>
            Széles szín­tartomány (P3)<br>
            Haptikus érintés<br>
            2 000 000:1 kontrasztarány (tipikus)<br>
            1000 nites maximális fényerő (tipikus); 1200 nites maximális fényerő (HDR)<br>
            Ujjlenyomatok ellen védő, zsírtaszító bevonat<br>
            Több nyelv és karakterkészlet egyidejű megjelenítése<br>
          </p>
        </div>
        
        <form action="iphone13.php" method="POST">
          <input type="hidden" name="termek_nev" value="Apple iPhone 13">
          <input class="vasarlas" type="submit" value="Vásárlás"/>
        </form>
      </div>
    </main>
    
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
    </footer>
  </body>
</html>