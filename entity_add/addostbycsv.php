<?php
    include '../db.php';
    $db = new DB();

    if(isset($_FILES['csv']))
    {
        $dossier = 'F:\wamp64\www\animelist/csv/';
        $fichier = basename($_FILES['csv']['name']);
        if(move_uploaded_file($_FILES['csv']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
            $fichier = fopen($dossier.$_FILES['csv']['name'], "r");


            if (($handle = fopen($dossier.$_FILES['csv']['name'], "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 100000, ";")) !== FALSE) {
                    try{
                        $db->insertOSTByCSV($data[0],$data[1],$data[2],$data[3],$data[4]);
                        header('location:../ost.php?successcsv=1');
                    }catch(Exception $e){
                        echo $e->getMessage();
                    }
                }
            }
        }
    }
?>