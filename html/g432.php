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
        <p><b>Hangsugarzok:</b> 50mm</p>
        <p><b>Frekvencia:</b> 20Hz - 20.000Hz </p>
        <p><b>Impedancia:</b> 39 Ohm</p>
        <p><b>Suly:</b> 259 g</p>
    </aside>

      <div style="text-align: center; overflow: hidden; padding: 30px;">
        <h2>Logitech G432</h2><br>
        <img class="tkep" id="trmk" src="../img/g432.png" alt="Logitech G432"/><br>
        <video controls width="480">
          <source src="../vid/iphone_12_ad.mp4" type="video/mp4"/>
        </video>
        <div style="text-align: left;">
          <p id="termek-leiras">
            Az 50 mm-es hangsugárzók a játékélményt mindent betöltő hanggal mélyítik. Kedvenc játékai végre úgy szólalnak meg, ahogyan a készítői elképzelték: lenyűgözően.<br>

           A tökéletesített és nagyobb, 6 mm-es mikrofonnal csapattársai mindig hallani fogják. A mikrofonkar átbillentésével elnémíthatja hangját, ha nem akarja, hogy hallatsszon.<br>

Új generációs DTS Headphone:X 2.0 térhangzás2A DTS Headphone:X 2.0 térhatású hang és a hangszínszabályzó-beállítások csak Windows operációs rendszerhez érhetők el, és Logitech G HUB játékszoftvert igényelnek. a Logitech G HUB szoftver támogatásával, amely révén hallhatja a hátul lopakodó ellenséget, az árulkodó hangokat, a helyszín zajait - mindezt maga körül. Élvezze a 7.1 csatornát is felülmúló 3D hangot, amelytől az események középpontjában érezheti magát.
<br>

          </p>
        </div>

        <form action="g432.php" method="POST">
          <input type="hidden" name="termek_nev" value="Logitech G432">
          <input class="vasarlas" type="submit" value="Vásárlás"/>
        </form>
      </div>
    </main>
    
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
    </footer>
  </body>
</html>