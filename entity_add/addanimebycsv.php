<?php
    include '../db.php';
    $db = new DB();

    $anime = 0;
    $genre = 0;
    if(isset($_FILES['csv'])){
        $anime = 1;
    }
    if($_FILES['csvgenre']['name'] !== ''){
        $genre = 1;
    }

    try{
        if(isset($_FILES['csv']))
        {
            $dossier = 'F:\wamp64\www\animelist/csv/';
            $fichier = basename($_FILES['csv']['name']);
            if(move_uploaded_file($_FILES['csv']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                $request = $db->prepareRequest("INSERT IGNORE INTO anime (nom, nb_ep, nb_oav, nb_film, note, synopsis, Auteur, Studio, img, imglarge) VALUES (?,?,?,?,?,?,?,?,?,?)");
                if (($handle = fopen($dossier.$_FILES['csv']['name'], "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 100000, ";")) !== FALSE) {
                        try{
                            $synopsis = iconv("CP1252","UTF-8" , $data[5]);
                            $db->insertAnimeByCSV($request, $data[0],$data[1],$data[2],$data[3],$data[4],$synopsis,$data[6],
                                $data[7],$data[8],$data[9]);
                            $anime = 1;
                            /*if($genre == 0){
                                header('location:../animelist.php?successcsv=1');
                            }*/
                        }catch(Exception $e){
                            echo $e->getMessage();
                        }
                    }
                }
            }
        }

        if(isset($_FILES['csvgenre']))
        {
            $dossier = 'F:\wamp64\www\animelist/csv/';
            $fichier = basename($_FILES['csvgenre']['name']);
            if(move_uploaded_file($_FILES['csvgenre']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                if (($handle = fopen($dossier.$_FILES['csvgenre']['name'], "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 100000, ";")) !== false){
                        try{
                            $db->insertAnimeGenreByCSV($data[0], $data[1]);
                            $genre = 1;
                            header('location:../animelist.php?successcsv=1');
                        }catch(Exception $e){
                            echo $e->getMessage();
                        }
                    }
                }
            }
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
?>