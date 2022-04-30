<?php
  $registered = true;

  $welcome = "";
  session_start();
  if (isset($_SESSION["keresztnev"]) && isset($_SESSION["email"])) {
    $welcome = "Szia " . $_SESSION["keresztnev"] . "!";
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
      $statement = $db->prepare("SELECT * FROM Felhasznalok WHERE email=:email");
      $statement->bindValue(":email", $_POST["email"], SQLITE3_TEXT);
      $results = $statement->execute();
      if (empty($results->fetchArray())) {
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
      } else {
        $registered = false;
      }
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
      <?php if (isset($_POST["keresztnev"]) && !$registered) { echo "<b style=\"color: red;\">Ezzel az email címmel már regisztráltak!</b>"; } ?>
      <form action="regisztracio.php" method="POST">
        <fieldset>
          <legend><b>Regisztráció</b></legend>
          <label>Keresztnév: <input id="keresztnev" type="text" name="keresztnev" placeholder="Töltsd ki!" required/></label> <br/><br/>
          <label>Vezetéknév: <input id="vezeteknev" type="text" name="vezeteknev" placeholder="Töltsd ki!" required/></label> <br/><br/>
          <label>Születési dátum: <input id="szul_datum" type="date" name="szul_datum" required/></label> <br/><br/>
          <label>Település: <input id="telepules" type="text" name="telepules" placeholder="Töltsd ki!" required/></label> <br/><br/>
          <label>Lakcím: <input id="lakcim" type="text" name="lakcim" placeholder="Töltsd ki!" required/></label> <br/><br/>
          <label>Email cím: <input id="email" type="email" name="email" placeholder="Töltsd ki!" required/></label> <br/><br/>
          <label>Jelszó: <input id="jelszo" type="password" name="jelszo" placeholder="Töltsd ki!" onKeyUp="jelszoEllenorzes()" required/></label> <br/><br/>
          <label>Jelszó újra: <input id="jelszo_ujra" type="password" name="jelszo_ujra" placeholder="Töltsd ki!" onKeyUp="jelszoEllenorzes()" required/></label> <br/><br/>
          <input id="elkuldes" type="submit" value="Regisztráció"/>
          <input type="reset" value="Adatok törlése"/>
        </fieldset>
      </form>
      <b id="hiba" style="color: red;"></b>
    </main>
    
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
      <script src="jelszoEllenorzes.js"></script>
    </footer>
  </body>
</html>