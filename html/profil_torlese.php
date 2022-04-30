<?php
    session_start();
    if(isset($_POST["email"])) {
        $db = new SQLite3("../db/db.db");
        $statement = $db->prepare("DELETE FROM Felhasznalok WHERE email=:email");
        $statement->bindValue(":email", $_POST["email"], SQLITE3_TEXT);
        $statement->execute();
    }
    
    if (isset($_POST["admin"])) {
        header("Location: admin.php");
    } else {
        header("Location: kijelentkezes.php");
    }
?>