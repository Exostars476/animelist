<?php
    include '../db.php';
    $db = new DB();

    $login    = isset($_POST['login']) ? htmlentities($_POST['login']) : '';
    $pass = isset($_POST['pass']) ? htmlentities($_POST['pass']) : '';
    $passcrypt = sha1($pass); // Cryptage du mot de passe

    if (isset($_POST['login'])) {
        $db->identification($login,$passcrypt);  // Vérification base de données
    } else {
        header("Location: login.php?error=2"); // Redirection et message d'erreur
    }

    $db->close();
?>