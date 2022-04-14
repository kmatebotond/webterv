<?php
    session_start();
    unset($_SESSION["keresztnev"]);
    unset($_SESSION["email"]);

    header("Location: index.php");
?>