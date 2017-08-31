<?php
    include 'db.php';
    $db = new DB();

    session_start();
    if (isset($_SESSION['access'])){
        $access = $_SESSION['access'];
    }

    $animetosearch = $_GET['animetosearch'];

    $animerequest = "SELECT id, nom, nb_ep, nb_oav, nb_film, note, img FROM anime WHERE anime.nom LIKE '%$animetosearch%' ORDER BY nom;";
    $ostrequest = "SELECT ost.id as id, type_ost, titre, ost.auteur as auteur, ost.note as note, anime_id, anime.nom as nom FROM ost 
                   INNER JOIN anime ON(ost.anime_id = anime.id) WHERE titre LIKE '%$animetosearch%' ORDER BY titre";
?>
<!DOCTYPE html>
<html lang="en" style="height:100%;">
<head>
    <meta charset="UTF-8">
    <title>AnimeList</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/animelist.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">AnimeList</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">Accueil</a></li>
                <li class="active"><a href="animelist.php">Animes</a></li>
                <li><a href="ost.php">Classement OST</a></li>
            </ul>
            <form method="get" action="search.php" class="navbar-form navbar-left">
                <div class="input-group">
                    <input name="animetosearch" type="text" class="form-control" placeholder="Recherche anime/ost">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if (isset($_SESSION['login']) AND isset($_SESSION['access'])){
                        echo "<li><a href=\"log-pages/logout.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Logout</a></li>";
                    }
                    else{
                        echo"
                        <li><a href=\"log-pages/signup.php\"><span class=\"glyphicon glyphicon-user\"></span> Sign Up</a></li>
                        <li><a href=\"log-pages/login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
                    }
                ?>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-6">
            <div class="container-fluid margin-top">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h1>Animes</h1></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Anime</th>
                                    <th style='text-align:center'>Genre</th>
                                    <th style='text-align:center'>Épisodes</a></th>
                                    <th style='text-align:center'>OAV</th>
                                    <th style='text-align:center'>Films</th>
                                    <th style='text-align:center'>Note</th>
                                </tr>
                                </thead>
                                <?php
                                $animeresult = $db->selectRequest($animerequest);
                                foreach($animeresult as $row){
                                    $id = $row['id'];
                                    $genrerequest = "SELECT genre.nom FROM genre INNER JOIN anime_genre ON(genre.id = anime_genre.genre_id) 
                                                             INNER JOIN anime ON(anime_genre.anime_id = anime.id) WHERE anime.id = $id;";
                                    $genreresult = $db->selectRequest($genrerequest);
                                    echo "
                                <tr class='handcursor' onclick='document.location.href=\"animedetail.php?id=".$id."\"'>                                    
                                    <td style='vertical-align:middle;' width='300px'>
                                        <span style='font-size:20px;' class='spantitle'>".$row['nom']."</span>
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
                                                $color = "jauneclair";
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
                                    <td style='vertical-align:middle; text-align:center'>".$row['nb_ep']."</td>
                                    <td style='vertical-align:middle; text-align:center'>".$row['nb_oav']."</td>
                                    <td style='vertical-align:middle; text-align:center'>".$row['nb_film']."</td>
                                    <td style='vertical-align:middle; text-align:center'>".$row['note']."</td>
                                </tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="container-fluid margin-top">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h1>OST</h1></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th style='text-align:center'>Interprète</th>
                                        <th style='text-align:center'>Note</th>
                                        <th style='text-align:center'>Anime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $ostresult = $db->selectRequest($ostrequest);
                                foreach($ostresult as $row){
                                    $animeid = $row['anime_id'];
                                    $thisnote = $row['note'];
                                    if($thisnote == 100){
                                        $txtcolor = 'blue';
                                    }
                                    else if($thisnote < 100 && $thisnote >= 75){
                                        $txtcolor = '#00E024';
                                    }
                                    else if($thisnote < 75 && $thisnote >= 50){
                                        $txtcolor = '#00B2FF';
                                    }
                                    else if($thisnote < 50 && $thisnote >= 25){
                                        $txtcolor = '#FF6E00';
                                    }
                                    else if($thisnote < 25 && $thisnote >= 0){
                                        $txtcolor = 'red';
                                    }
                                    echo"
                                        <tr style='cursor:pointer;' onclick='document.location.href=\"editost.php?id=".$row['id']."\"'>
                                            <td class='normalsize'>".$row['titre']."</td>
                                            <td style='text-align:center' class='normalsize'>".$row['auteur']."</td>
                                            <td style='text-align:center' class='bold normalsize'>
                                                <span style='color:".$txtcolor."' class='note'>".$row['note']."</span>
                                                <span style='color:blue;'> /100</span>
                                            </td>
                                            <td style='text-align:center' class='normalsize'><a style='color:#555;' href='animedetail.php?id=".$animeid."'>".$row['nom']."</a></td>                              
                                        </tr>";
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
