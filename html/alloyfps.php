<?php
  $welcome = "";
  session_start();
  if (isset($_SESSION["keresztnev"]) && isset($_SESSION["email"])) {
    $welcome = "Szia " . $_SESSION["keresztnev"] . "!";
    
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
        <?php echo $welcome; ?>
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
        <p><b>USB:</b> Type-C</p>
        <p><b>Mechanikus:</b> Igen </p>
        <p><b>Szerkezet: </b> Alluminium</p>
        <p><b>Tomeg:</b> 781 g</p>
    </aside>

      <div style="text-align: center; overflow: hidden; padding: 30px;">
        <h2>HyperX Alloy FPS</h2><br>
        <img class="tkep" id="trmk" src="../img/alloyfps.png" alt="HyperX Alloy FPS"/><br>
        <video controls width="480">
          <source src="../vid/alloyfps.mp4" type="video/mp4"/>
        </video>
        <div style="text-align: left;">
          <p id="termek-leiras">
A HyperX Alloy Origins 60 billentyűzetet kifejezetten gamerek, lelkes streamelők vagy igényes felhasználók számára tervezték. Elsősorban azoknak, akiknek kicsi a munkaterületük, vagy állandóan utaznak, és szeretnék, ha kedvenc billentyűzetük mindig náluk lenne. Ugyanis a HyperX Alloy Origins 60 billentyűzet fizikai méretei a szabványos gamer billentyűzetek 60%-ának felelnek meg. Természetesen rendkívüligondossággal és a legjobb és legtartósabb anyagok felhasználásával készítették. Különösen értékelni fogod a prémium kategóriás HyperX mechanikus kapcsolókat, az eredeti RGB háttérvilágítást vagy a levehető USB-C kábelt.

          </p>
        </div>

        <form action="alloyfps.php" method="POST">
          <input type="hidden" name="termek_nev" value="HyperX Alloy FPS">
          <input class="vasarlas" type="submit" value="Vásárlás"/>
        </form>
      </div>
    </main>
    
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
    </footer>
  </body>
</html>