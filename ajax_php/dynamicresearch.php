<?php
    include "../db.php";
    $db = new DB();

    $name = $_POST['name'];

    // Je fais les traitements qui vont bien : requêtes SQL, algorithmes etc...
    $retour = null;
    $animerequest = "SELECT * FROM anime WHERE nom LIKE '".$name."%'";
    $listAnime = $db->selectRequest($animerequest);
    foreach($listAnime as $row)
    {
        $id = $row['id'];
        switch($row['note']){
            case 1:
            case 2:
            case 3:
            case 4:
                $txtcolor = 'red';
                break;
            case 5:
            case 6:
            case 7:
                $txtcolor = '#FF6E00';
                break;
            case 8:
            case 9:
                $txtcolor = '#00E024';
                break;
            case 10:
                $txtcolor = 'blue';
                break;
            default:
                $txtcolor = 'blue';
                break;
        }
        $genrerequest = "SELECT genre.nom FROM genre INNER JOIN anime_genre ON(genre.id = anime_genre.genre_id) 
                                                     INNER JOIN anime ON(anime_genre.anime_id = anime.id) WHERE anime.id = $id;";
        $genreresult = $db->selectRequest($genrerequest);
        echo "<tr class='handcursor' onclick='document.location.href=\"animedetail.php?id=".$id."\"'>
                <td width='170px' style='vertical-align:middle;'>
                    <img height='150px' width='150px' style='margin-right:20px;' src=".$row['img']."></img>
                </td>
                <td style='vertical-align:middle;' width='400px'>
                    <span class='spantitle'>".$row['nom']."</span>
                </td>
                <td style='vertical-align:middle;'>";
                    foreach($genreresult as $line){
                        switch ($line['nom']){
                            case "ACTION":
                                $color = "orange";
                                break;
                            case "AVENTURE":
                                $color = "vert";
                                break;
                            case "AMOUR ET AMITIE":
                                $color = "rose";
                                break;
                            case "COMBAT":
                                $color = "rouge";
                                break;
                            case "COMEDIE":
                                $color = "jaune";
                                break;
                            case "CYBER ET MECHA":
                                $color = "gris";
                                break;
                            case "DRAME":
                                $color = "noir";
                                break;
                            case "ECCHI":
                                $color = "rougeclair";
                                break;
                            case "ENIGME ET POLICIER":
                                $color = "marron";
                                break;
                            case "EPIQUE ET HEROIQUE":
                                $color = "bleuroi";
                                break;
                            case "SCIENCE-FICTION":
                                $color = "violet";
                                break;
                            case "FANTASTIQUE":
                                $color = "rosefoncer";
                                break;
                            case "HORREUR":
                                $color = "orangefoncer";
                                break;
                            case "MAGICAL GIRL":
                                $color = "rosebombom";
                                break;
                            case "MUSICAL":
                                $color = "cyan";
                                break;
                            case "SPORT":
                                $color = "marronclair";
                                break;
                            case "TRANCHE DE VIE":
                                $color = "bleu";
                                break;
                            default:
                                $color = "white";
                                break;
                        }
                        echo "<div class=$color>".$line['nom']."</div>";
                    }
                echo"
                </td>
                <td class='bold normalsize' style='vertical-align:middle; text-align:center'>".$row['nb_ep']."</td>
                <td class='bold normalsize' style='vertical-align:middle; text-align:center'>".$row['nb_oav']."</td>
                <td class='bold normalsize' style='vertical-align:middle; text-align:center'>".$row['nb_film']."</td>
                <td class='bold normalsize' style='vertical-align:middle; text-align:center'><span style='color:".$txtcolor."'>".$row['note']."</span> / <span style='color:blue;'>10</span></td>
            </tr>";
    }  // envoi de la réponse (ça pourrait être du code html, un objet serializé etc.. l'important c'est qu'il s'agit d'une String)
?>