<?php
  session_start();
  if (isset($_SESSION["keresztnev"]) && isset($_SESSION["email"])) {
    echo "Szia " . $_SESSION["keresztnev"] . "!";
    
    if (isset($_POST["termek_nev"])) {
      $db = new SQLite3("../db/db.db");
      $statement = $db->prepare("INSERT INTO Rendelesek (email, termek_nev) VALUES (:email, :termek_nev)");
      $statement->bindValue(":email", $_SESSION["email"], SQLITE3_TEXT);
      $statement->bindValue(":termek_nev", "iPhone 12 Mini", SQLITE3_TEXT);
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
        <h2>iPhone 12 Mini</h2><br>
        <img class="tkep" src="../img/iphone_12_mini.jpg" alt="iPhone 12 Mini"/><br>
        <video controls width="480">
          <source src="../vid/iphone_12_ad.mp4" type="video/mp4"/>
        </video>
        <div style="text-align: left;">
          <p id="termek-leiras" style="float: left">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec varius metus.
            Proin convallis auctor ex. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;
            Proin vitae odio porttitor, finibus diam eu, mollis lectus. In hac habitasse platea dictumst. Sed vulputate massa tortor,
            ut sollicitudin leo porttitor a. Vivamus congue arcu id elit euismod porta id sit amet ligula. Mauris sit amet vestibulum erat.
            Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
          </p>
        </div>
        
        <form action="termek.php" method="POST">
          <input type="hidden" name="termek_nev" value="iPhone 12 Mini">
          <input type="submit" value="Vásárlás"/>
        </form>
      </div>
    </main>
    
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
    </footer>
  </body>
</html>