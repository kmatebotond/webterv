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
        <p><b>Erzekenyseg:</b> 1.600DPI</p>
        <p><b>Valaszido:</b> 0,3ms </p>
        <p><b>Gombok szama:</b> 5</p>
        <p><b>Tomeg:</b> 145 g</p>
    </aside>

      <div style="text-align: center; overflow: hidden; padding: 30px;">
        <h2>Logitech Mx Master</h2><br>
        <img class="tkep" id="trmk" src="../img/mxmaster.png" alt="Logitech Mx Master"/><br>
        <video controls width="480">
          <source src="../vid/mxmaster.mp4" type="video/mp4"/>
        </video>
        <div style="text-align: left;">
          <p id="termek-leiras">
Egy egyszerű hüvelykujj mozdulattal görgethetsz oldalirányba. Az oldalsó görgetőkerék összes lehetőségének kiaknázásához a Logitech Options szoftverrel saját igényeidre szabhatod az egér működését.

A Logitech MX Master oldalsó görgetővel elforgathatod az oldalakat, változtathatod a gombokhoz rendelt funkciókat, illetve sok más lehetőséged is van.

          </p>
        </div>

        <form action="mxmaster.php" method="POST">
          <input type="hidden" name="termek_nev" value="Logitech Mx Master">
          <input class="vasarlas" type="submit" value="Vásárlás"/>
        </form>
      </div>
    </main>
    
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
    </footer>
  </body>
</html>