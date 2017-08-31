<?php
    include "../db.php";
    $db = new DB();

    $request = "SELECT id, nom, img FROM anime ORDER BY RAND() LIMIT 1;";
    $result = $db->selectRequest($request);

    foreach($result as $row){
        $nom = $row['nom'];
        $img = $row['img'];
    }

    $value = array(
        'nom' => $nom,
        'img' => $img,
    );
    echo json_encode($value);
?>