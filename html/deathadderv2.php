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
        <p><b>Erzekenyseg:</b> 20.000DPI</p>
        <p><b>Valaszido:</b> 0,2ms </p>
        <p><b>Gombok szama:</b> 8</p>
        <p><b>Tomeg:</b> 82 g</p>
    </aside>

      <div style="text-align: center; overflow: hidden; padding: 30px;">
        <h2>Razer Deathadder V2</h2><br>
        <img class="tkep" id="trmk" src="../img/deathadderv2.png" alt="Razer Deathadder V2"/><br>
        <video controls width="480">
          <source src="../vid/deathadderv2.mp4" type="video/mp4"/>
        </video>
        <div style="text-align: left;">
          <p id="termek-leiras">
Megbízható egeret keresel, amely egyetlen játék során sem okoz csalódást? A Razer DeathAdder V2 mindennel rendelkezik, amelyre a számítógépes játékok szerelmeseinek szüksége lehet - maximális kényelmet, gyors reakciót és nagy pontosságot kínál. Az egér ergonomikus formája kényelmes fogást tesz lehetővé, így  akár többórás játék közben is kényelmesen használhatod. A Razer DeathAdder V2 optikai kapcsolóval rendelkezik, amely minden kattintásod infravörös fénnyel érzékeli. Ennek eredményeként az egér megdöbbentő, mindössze 0,2 milliszekundumos gyors válaszideje versenyelőnyt jelenthet ellenfeleiddel szemben. A továbbfejlesztett Razer Focus+ optikai érzékelő állítha, akár 20 000 DPI felbontással és 99,6% -os pontossággal biztosítja a legkisebb mozgások zökkenőmentességét. Nyolc teljesen programozható gomb bővíti ki az egér vezérlését. A Razer Speedflex egér USB-kábellel csatlakozik az eszközökhöz, amely minimális ellenállást produkál, nem gubancolódik és nem dörzsölődik ki. A színes háttérvilágítás gazdagkínálata kiemeli a megfelelő légkört és játékélményt.

          </p>
        </div>

        <form action="deathadderv2.php" method="POST">
          <input type="hidden" name="termek_nev" value="Razer Deathadder V2">
          <input class="vasarlas" type="submit" value="Vásárlás"/>
        </form>
      </div>
    </main>
    
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
    </footer>
  </body>
</html>