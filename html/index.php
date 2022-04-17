<?php
  session_start();
  if (isset($_SESSION["keresztnev"]) && isset($_SESSION["email"])) {
    echo "Szia " . $_SESSION["keresztnev"] . "!";
  }
?>

<!DOCTYPE html>
<html lang="hu">
  <head>
    <title>Kezdőoldal</title>
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
      <section>
        <h3 class="cimke"><b>Telefonok</b></h3>
        
        <a class="termek" href="iphone13.php">
          <img class="tkep" style="height:10em" src="../img/iphone13.png" alt="Apple iPhone 13"/>
          <p class="tnev">Apple <br>iPhone 13</p>
        </a>
        <a class="termek" href="galaxys21.php">
          <img class="tkep" style="height:10em" src="../img/galaxys21.png" alt="Samsung Galaxy S21"/>
          <p class="tnev">Samsung <br>Galaxy S21</p>
        </a>
      </section>
      
      <section>
        <h3 class="cimke"><b>Fülhallgatók</b></h3>
        
        <a class="termek" href="g432.php">
          <img class="tkep" style="height:10em" style="height:10em" src="../img/g432.png" alt="Logitech G432"/>
          <p class="tnev">Logitech <br>G432</p>
        </a>
        <a class="termek" href="cloud2.php">
          <img class="tkep" style="height:10em" style="height:10em" src="../img/cloud2.png" alt="HyperX Cloud 2"/>
          <p class="tnev">HyperX<br> Cloud 2</p>
        </a>
      </section>
      
      <section>
        <h3 class="cimke"><b>Egerek</b></h3>
        
        <a class="termek" href="deathadderv2.php">
          <img class="tkep" style="height:10em" src="../img/deathadderv2.png" alt="Razer Deathadder V2"/>
          <p class="tnev">Razer <br>Deathadder V2</p>
        </a>
        <a class="termek" href="mxmaster.php">
          <img class="tkep" style="height:10em" src="../img/mxmaster.png" alt="Logitech Mx Master"/>
          <p class="tnev">Logitech <br>Mx Master</p>
        </a>
      </section>
      
      
      <section>
        <h3 class="cimke"><b>Billentyűzetek</b></h3>
        
        <a class="termek" href="bwchroma.php">
          <img class="tkep" src="../img/bwchroma.png" alt="Razer Blackwidow Chroma"/>
          <p class="tnev">Razer Blackwidow <br>Chroma</p>
        </a>
        <a class="termek" href="alloyfps.php">
          <img class="tkep" src="../img/alloyfps.png" alt="HyperX Alloy FPS"/>
          <p class="tnev">HyperX Alloy FPS</p>
        </a>
      </section>
    </main>
      
    <footer>
      A weboldalt készítette Kiss Máté Botond és László Dávid
    </footer>
  </body>
</html>