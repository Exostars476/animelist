<?php
    include '../db.php';
    $db = new DB();

    if(isset($_GET['term'])) {
        // Mot tapé par l'utilisateur

        // Requête SQL

        $requete = "SELECT nom from anime WHERE nom LIKE '%" . addslashes($_GET['term']) . "%' LIMIT 0, 10";

        // Exécution de la requête SQL
        $resultat = $db->selectRequest($requete) or die(print_r($db->errorInfo()));

        // On parcourt les résultats de la requête SQL
        while($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
            // On ajoute les données dans un tableau
            foreach($row as $val)
                $tab[] = $val;
        }

        // On renvoie le données au format JSON pour le plugin
        echo json_encode($tab);
    }
?>
