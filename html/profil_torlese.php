<?php
    session_start();
    $db = new SQLite3("../db/db.db");
    $statement = $db->prepare("DELETE FROM Felhasznalok WHERE email=:email");
    $statement->bindValue(":email", $_SESSION["email"], SQLITE3_TEXT);
    $statement->execute();

    header("Location: kijelentkezes.php");
?>