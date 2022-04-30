<?php
  $welcome = "";
  session_start();
  if (isset($_SESSION["keresztnev"]) && isset($_SESSION["email"])) {
    $welcome = "Szia " . $_SESSION["keresztnev"] . "!";
  }
?>

<!DOCTYPE html>
<html lang="hu">
  <head>
    <title>Rólunk</title>
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
          <a class="active bal"  href="rolunk.php">Rólunk</a>

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
      <div id="rolunk">
        <h2>A webáruházról</h2>
        <p>
          Ez a webáruház elektronikai eszközök eladására szolgál.
        </p>
        <p>
          Mindenféle informatikai eszköz megtalálható rajta.
        </p>
        <hr>
        <h2>Elérhetőségek</h2>
        <p>
          <strong>Telefon:</strong> +111 1111 1111<br>
        </p>
        <p>
          <strong>E-mail:</strong> webtervprojekt1@gmail.com
        </p>
        <p>
          <strong>Üzlet címe:</strong> Szeged 6724, Web Áruház 22
        </p>
      </div>
    </main>
    
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
    </footer>
  </body>
</html>