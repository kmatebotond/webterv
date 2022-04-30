<?php
  $welcome = "";
  session_start();
  if (isset($_SESSION["keresztnev"]) && isset($_SESSION["email"])) {
    $welcome = "Szia " . $_SESSION["keresztnev"] . "!";

    $db = new SQLite3("../db/db.db");
    $statement = $db->prepare("SELECT is_admin FROM Felhasznalok WHERE email=:email");
    $statement->bindValue(":email", $_SESSION["email"], SQLITE3_TEXT);
    $results = $statement->execute();
    $row = $results->fetchArray();
    if (!empty($row)) {
      if ($row["is_admin"] == 0) {
        header("Location: index.php");
      }
    }
  } else {
    header("Location: bejelentkezes.php");
  }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <title>Profil</title>
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
        <div id=profil>
        <table>
          <thead>
            <tr>
              <th colspan="2">Felhasználók</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $statement = $db->prepare("SELECT * FROM Felhasznalok");
              $results = $statement->execute();
              $i = 1;
              while ($row = $results->fetchArray()) {
                echo "<tr";
                if ($i % 2 == 0) {
                  echo " class=\"paros\"";
                }
                echo ">";

                echo "<td>" . $row["email"] . "</td>";
                echo "<td>";
                echo "<form action=\"profil_torlese.php\" method=\"POST\">";
                echo "<input type=\"hidden\" name=\"admin\"/>";
                echo "<input type=\"hidden\" name=\"email\" value=\"" . $row["email"] . "\"/>";
                echo "<input class=\"vasarlas\" type=\"submit\" value=\"Törlés\"/>";
                echo "</form>";
                echo "</td>";

                echo "</tr>";

                $i++;
              }
            ?>
          </tbody>
        </table>
        </div>
    </main>      
</body>