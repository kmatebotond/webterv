<?php
  session_start();
  if (isset($_SESSION["keresztnev"]) && isset($_SESSION["email"])) {
    echo "Szia " . $_SESSION["keresztnev"] . "!";

    $db = new SQLite3("../db/db.db");
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
    <div id="profil">
        <h2>Felhasználói profil</h2>
        <table>

            <thead>
            <tr>
                <th colspan="2">Adatok</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <b>Keresztnév</b>
                </td>
                <td><?php echo $keresztnev ?></td>
            </tr>
            <tr class="paros">
                <td>
                    <b>Vezetéknév</b>
                </td>
                <td><?php echo $vezeteknev ?></td>
            </tr>
            <tr>
                <td>
                    <b>Születési dátum</b>
                </td>
                <td><?php echo $szul_datum ?></td>
            </tr>
            <tr class="paros">
                <td>
                    <b>Település</b>
                </td>
                <td><?php echo $telepules ?></td>
            </tr>
            <tr>
                <td>
                    <b>Lakcím</b>
                </td>
                <td><?php echo $lakcim ?></td>
            </tr>
            <tr class="paros">
                <td>
                    <b>E-mail</b>
                </td>
                <td><?php echo $email ?></td>
            </tr>
            </tbody>
        </table>

        <form action="adatmodositas.php" method="POST">
          <input class="vasarlas" type="submit" value="Adatmódosítás"/>
        </form>

        <table>
          <thead>
            <tr>
              <th>Rendelések</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $statement = $db->prepare("SELECT * FROM Rendelesek WHERE email=:email");
              $statement->bindValue(":email", $_SESSION["email"], SQLITE3_TEXT);
              $results = $statement->execute();
              $i = 1;
              while ($row = $results->fetchArray()) {
                echo "<tr";
                if ($i % 2 == 0) {
                  echo " class=\"paros\"";
                }
                echo ">";

                echo "<td>" . $row["termek_nev"] . "</td>";

                echo "</tr>";

                $i++;
              }
            ?>
          </tbody>
        </table>
    </div>


</main>
<footer>
    A weboldalt készítette Kiss Máté Botond és László Dávid
</footer>
</body>
</html>