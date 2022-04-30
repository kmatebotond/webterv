<?php
  $logged_in = true;

  $welcome = "";
  session_start();
  if (isset($_SESSION["keresztnev"]) && isset($_SESSION["email"])) {
    $welcome = "Szia " . $_SESSION["keresztnev"] . "!";
  }

  if (isset($_POST["email"]) && isset($_POST["jelszo"])) {
    $logged_in = false;
    $db = new SQLite3("../db/db.db");
    $statement = $db->prepare("SELECT keresztnev, jelszo FROM Felhasznalok WHERE email=:email");
    $statement->bindValue(":email", $_POST["email"], SQLITE3_TEXT);
    $results = $statement->execute();
    $row = $results->fetchArray();
    if (!empty($row)) {
      if (password_verify($_POST["jelszo"], $row["jelszo"])) {
        $logged_in = true;
        $_SESSION["keresztnev"] = $row["keresztnev"];
        $_SESSION["email"] = $_POST["email"];

        header("Location: index.php");
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <title>Bejelentkezés</title>
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
            <a  class="jobb" href="regisztracio.php">Regisztráció</a>
            <?php
              echo "<a class=\"active jobb\" href=\"";
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
      <form action="bejelentkezes.php" method="POST">
        <fieldset>
          <legend><b>Bejelentkezés</b></legend>
          <label>Email cím: <input type="email" name="email" required/></label> <br/><br/>
          <label>Jelszó: <input type="password" name="jelszo" required/></label> <br/><br/>
          <input type="submit" value="Bejelentkezés"/>
        </fieldset>
      </form>
      <?php if (isset($_POST["email"]) && isset($_POST["jelszo"]) && !$logged_in) { echo "<b style=\"color: red;\">Hibás email vagy jelszó.</b>"; } ?>
    </main>
    
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
    </footer>
  </body>
</html>