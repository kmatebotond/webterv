<?php
  $db = new SQLite3("../db/db.db");

  $welcome = "";
  session_start();
  if (isset($_SESSION["keresztnev"]) && isset($_SESSION["email"])) {
    $welcome = "Szia " . $_SESSION["keresztnev"] . "!";

    $statement = $db->prepare("SELECT * FROM Felhasznalok WHERE email=:email");
    $statement->bindValue(":email", $_SESSION["email"], SQLITE3_TEXT);
    $results = $statement->execute();
    $row = $results->fetchArray();
    if (!empty($row)) {
      $keresztnev = $row["keresztnev"];
      $vezeteknev = $row["vezeteknev"];
      $szul_datum = $row["szul_datum"];
      $telepules = $row["telepules"];
      $lakcim = $row["lakcim"];
      $email = $row["email"];
    }
  }

  if (
    isset($_POST["keresztnev"]) &&
    isset($_POST["vezeteknev"]) &&
    isset($_POST["szul_datum"]) &&
    isset($_POST["telepules"]) &&
    isset($_POST["lakcim"]) &&
    isset($_POST["email"]) &&
    isset($_POST["uj_jelszo"]) &&
    isset($_POST["uj_jelszo_ujra"]) &&
    isset($_POST["regi_jelszo"])
    ) {
    $statement = $db->prepare("SELECT jelszo FROM Felhasznalok WHERE email=:email");
    $statement->bindValue(":email", $_POST["email"], SQLITE3_TEXT);
    $results = $statement->execute();
    $row = $results->fetchArray();
    if (!empty($row)) {
      if (password_verify($_POST["regi_jelszo"], $row["jelszo"])) {
        $statement = $db->prepare("UPDATE Felhasznalok SET keresztnev=:keresztnev, vezeteknev=:vezeteknev, szul_datum=:szul_datum, telepules=:telepules, lakcim=:lakcim, email=:email, jelszo=:jelszo WHERE email=:regi_email");
        $statement->bindValue(":keresztnev", $_POST["keresztnev"], SQLITE3_TEXT);
        $statement->bindValue(":vezeteknev", $_POST["vezeteknev"], SQLITE3_TEXT);
        $statement->bindValue(":szul_datum", $_POST["szul_datum"], SQLITE3_TEXT);
        $statement->bindValue(":telepules", $_POST["telepules"], SQLITE3_TEXT);
        $statement->bindValue(":lakcim", $_POST["lakcim"], SQLITE3_TEXT);
        $statement->bindValue(":email", $_POST["email"], SQLITE3_TEXT);
        $statement->bindValue(":jelszo", password_hash($_POST["uj_jelszo"], PASSWORD_DEFAULT, ["cost" => 12]), SQLITE3_TEXT);
        $statement->bindValue(":regi_email", $_SESSION["email"], SQLITE3_TEXT);
        $statement->execute();
      }
    }

    header("Location: profil.php");
  }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
  <title>Adatmódosítás</title>
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
          <a class="active bal" href="profil.php">Profil</a>
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
      <form action="adatmodositas.php" method="POST">
        <fieldset>
          <legend><b>Adatmódosítás</b></legend>
          <label>Keresztnév: <input type="text" name="keresztnev" value="<?php echo $keresztnev?>" required/></label> <br/><br/>
          <label>Vezetéknév: <input type="text" name="vezeteknev" value="<?php echo $vezeteknev?>" required/></label> <br/><br/>
          <label>Születési dátum: <input type="date" name="szul_datum" value="<?php echo $szul_datum?>" required/></label> <br/><br/>
          <label>Település: <input type="text" name="telepules" value="<?php echo $telepules?>" required/></label> <br/><br/>
          <label>Lakcím: <input type="text" name="lakcim" value="<?php echo $lakcim?>" required/></label> <br/><br/>
          <label>Email cím: <input type="email" name="email" value="<?php echo $email?>" required/></label> <br/><br/>
          <label>Új elszó: <input id="jelszo" type="password" name="uj_jelszo" onKeyUp="jelszoEllenorzes()" required/></label> <br/><br/>
          <label>Új jelszó újra: <input id="jelszo_ujra" type="password" name="uj_jelszo_ujra" onKeyUp="jelszoEllenorzes()" required/></label> <br/><br/>
          <label>Régi jelszó<input type="password" name="regi_jelszo" required/></label> <br/><br/>
          <input id="elkuldes" type="submit" name="adatmodositas" value="Adatmódosítás"/>
        </fieldset>
      </form>
    </main>
    
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
      <script src="jelszoEllenorzes.js"></script>
    </footer>
  </body>
</html>