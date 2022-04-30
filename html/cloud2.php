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
        <p><b>Hangsugarzok:</b> 53mm</p>
        <p><b>Frekvencia:</b> 15Hz - 25.000Hz </p>
        <p><b>Impedancia:</b> 60 Ohm</p>
        <p><b>Suly:</b> 268 g</p>
    </aside>

      <div style="text-align: center; overflow: hidden; padding: 30px;">
        <h2>HyperX Clound 2</h2><br>
        <img class="tkep" id="trmk" src="../img/cloud2.png" alt="HyperX Clound 2"/><br>
        <video controls width="480">
          <source src="../vid/cloud2.mp4" type="video/mp4"/>
        </video>
        <div style="text-align: left;">
          <p id="termek-leiras">
            A HyperX Cloud II Gunmetal egy professzionális vezetékes headset igényes gamereknek, akik kényelmet, alacsony tömeget, tartósságot, kiváló hangminőséget és más fejlett funkciókat keresnek. A puha párnázásnak köszönhetően a HyperX Cloud II Gunmetal még hosszú ideig tartó viselés esetén is maximális kényelmet biztosít. A fejhallgató rugalmas mikrofonnal rendelkezik környezeti zajszűréssel valamint támogatja a 7.1-es virtuális térhatású hangzást.


          </p>
        </div>

        <form action="cloud2.php" method="POST">
          <input type="hidden" name="termek_nev" value="HyperX Clound 2">
          <input class="vasarlas" type="submit" value="Vásárlás"/>
        </form>
      </div>
    </main>
    
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
    </footer>
  </body>
</html>