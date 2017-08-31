<?php
    include '../db.php';
    $db = new DB();

    $login = isset($_POST['login']) ? htmlentities($_POST['login']) : '';
    $pass = isset($_POST['pass']) ? htmlentities($_POST['pass']) : '';
    $reppass = isset($_POST['reppass']) ? htmlentities($_POST['reppass']) : '';
    $passcrypt = sha1($pass); // Cryptage du mot de passe

    // Vérification inscription
    if (isset($_POST['login'])){
        if($pass == $reppass){
            $db->insertUser($login,$passcrypt);                 // Insertion base de données, redirection, message de succès
            header('location: ../index.php?signup=1');
        }
        else{
            header("Location: signup.php?error=1");        // Redirection message d'erreur
        }
    } else {
        header("Location: signup.php?error=2");            // Redirection message d'erreur
    }

    $db->close();
?>