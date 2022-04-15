<?php
  session_start();
  if (isset($_SESSION["keresztnev"]) && isset($_SESSION["email"])) {
    echo "Szia " . $_SESSION["keresztnev"] . "!";
  }

  if (
    isset($_POST["keresztnev"]) &&
    isset($_POST["vezeteknev"]) &&
    isset($_POST["szul_datum"]) &&
    isset($_POST["telepules"]) &&
    isset($_POST["lakcim"]) &&
    isset($_POST["email"]) &&
    isset($_POST["jelszo"]) &&
    isset($_POST["jelszo_ujra"])
    ) {
    $db = new SQLite3("../db/db.db");
    $statement = $db->prepare("INSERT INTO Felhasznalok (keresztnev, vezeteknev, szul_datum, telepules, lakcim, email, jelszo) VALUES (:keresztnev, :vezeteknev, :szul_datum, :telepules, :lakcim, :email, :jelszo)");
    $statement->bindValue(":keresztnev", $_POST["keresztnev"], SQLITE3_TEXT);
    $statement->bindValue(":vezeteknev", $_POST["vezeteknev"], SQLITE3_TEXT);
    $statement->bindValue(":szul_datum", $_POST["szul_datum"], SQLITE3_TEXT);
    $statement->bindValue(":telepules", $_POST["telepules"], SQLITE3_TEXT);
    $statement->bindValue(":lakcim", $_POST["lakcim"], SQLITE3_TEXT);
    $statement->bindValue(":email", $_POST["email"], SQLITE3_TEXT);
    $statement->bindValue(":jelszo", password_hash($_POST["jelszo"], PASSWORD_DEFAULT, ["cost" => 12]), SQLITE3_TEXT);
    $statement->execute();

    header("Location: bejelentkezes.php");
  }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <title>Regisztráció</title>
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
          <a class="bal" href="index.php">Kezdőoldal</a>
          <a class="bal" href="profil.php">Profil</a>
          <a class="bal"  href="rolunk.php">Rólunk</a>

          <div class="jobb">
            <a  class="active jobb" href="regisztracio.php">Regisztráció</a>
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
      <form action="regisztracio.php" method="POST">
        <fieldset>
          <legend><b>Regisztráció</b></legend>
          <label>Keresztnév: <input type="text" name="keresztnev" required/></label> <br/><br/>
          <label>Vezetéknév: <input type="text" name="vezeteknev" required/></label> <br/><br/>
          <label>Születési dátum: <input type="date" name="szul_datum" required/></label> <br/><br/>
          <label>Település: <input type="text" name="telepules" required/></label> <br/><br/>
          <label>Lakcím: <input type="text" name="lakcim" required/></label> <br/><br/>
          <label>Email cím: <input type="email" name="email" required/></label> <br/><br/>
          <label>Jelszó: <input id="jelszo" type="password" name="jelszo" onKeyUp="jelszoEllenorzes()" required/></label> <br/><br/>
          <label>Jelszó újra: <input id="jelszo_ujra" type="password" name="jelszo_ujra" onKeyUp="jelszoEllenorzes()" required/></label> <br/><br/>
          <input id="elkuldes" type="submit" value="Regisztráció"/>
          <input type="reset" value="Adatok törlése"/>
        </fieldset>
      </form>
    </main>
    
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
      <script src="jelszoEllenorzes.js"></script>
    </footer>
  </body>
</html>