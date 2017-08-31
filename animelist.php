<?php
    include 'db.php';
    include 'fil_ariane.php';
    $db = new DB();

    session_start();
    if (isset($_SESSION['access'])){
        $access = $_SESSION['access'];
    }

    $selectgenrerequest = "SELECT id, nom FROM genre";

    if(isset($_GET['sort'])){
        switch ($_GET['sort']){
            case 'nom':
                $animerequest = "SELECT id, nom, nb_ep, nb_oav, nb_film, note, img FROM anime ORDER BY nom;";
                break;
            case 'ep':
                $animerequest = "SELECT id, nom, nb_ep, nb_oav, nb_film, note, img FROM anime ORDER BY nb_ep DESC;";
                break;
            case 'oav':
                $animerequest = "SELECT id, nom, nb_ep, nb_oav, nb_film, note, img FROM anime ORDER BY nb_oav DESC;";
                break;
            case 'film':
                $animerequest = "SELECT id, nom, nb_ep, nb_oav, nb_film, note, img FROM anime ORDER BY nb_film DESC;";
                break;
            case 'note':
                $animerequest = "SELECT id, nom, nb_ep, nb_oav, nb_film, note, img FROM anime ORDER BY note DESC;";
                break;
            default:
                $animerequest = "SELECT id, nom, nb_ep, nb_oav, nb_film, note, img FROM anime ORDER BY nom;";
                break;
        }
    }
    else{
        $animerequest = "SELECT id, nom, nb_ep, nb_oav, nb_film, note, img FROM anime ORDER BY nom;";
    }

    if(isset($_GET['genre1'])){
        $genre1 = $_GET['genre1'];
        $animerequest = "SELECT anime.id, anime.nom, nb_ep, nb_oav, nb_film, note, img FROM anime INNER JOIN anime_genre 
                                          ON(anime_genre.anime_id = anime.id) INNER JOIN genre ON(genre.id = anime_genre.genre_id)
                                          WHERE genre.nom LIKE '$genre1';";
        if(isset($_GET['genre2'])){
            $genre2 = $_GET['genre2'];
            $animerequest = "SELECT A.id, A.nom, A.nb_ep, A.nb_oav, A.nb_film, A.note, A.img FROM anime A WHERE A.id IN 
                              ( SELECT DISTINCT anime_id FROM anime_genre INNER JOIN 
                              genre ON(anime_genre.genre_id=genre.id) WHERE genre.nom='$genre1') AND A.id IN ( SELECT DISTINCT anime_id 
                              FROM anime_genre INNER JOIN genre ON(anime_genre.genre_id=genre.id) WHERE genre.nom='$genre2')";
            if(isset($_GET['genre3'])){
                $genre3 = $_GET['genre3'];
                $animerequest = "SELECT A.id, A.nom, A.nb_ep, A.nb_oav, A.nb_film, A.note, A.img FROM anime A WHERE A.id IN 
                              ( SELECT DISTINCT anime_id FROM anime_genre INNER JOIN 
                              genre ON(anime_genre.genre_id=genre.id) WHERE genre.nom='$genre1') AND A.id IN ( SELECT DISTINCT anime_id
                              FROM anime_genre INNER JOIN genre ON(anime_genre.genre_id=genre.id) WHERE genre.nom='$genre2')
                              AND A.id IN ( SELECT DISTINCT anime_id FROM anime_genre INNER JOIN genre ON(anime_genre.genre_id=genre.id)
                              WHERE genre.nom='$genre3')";
                if(isset($_GET['genre4'])){
                    $genre4 = $_GET['genre4'];
                    $animerequest = "SELECT A.id, A.nom, A.nb_ep, A.nb_oav, A.nb_film, A.note, A.img FROM anime A WHERE A.id IN 
                                    ( SELECT DISTINCT anime_id FROM anime_genre INNER JOIN 
                                    genre ON(anime_genre.genre_id=genre.id) WHERE genre.nom='$genre1') AND A.id IN ( SELECT DISTINCT anime_id
                                    FROM anime_genre INNER JOIN genre ON(anime_genre.genre_id=genre.id) WHERE genre.nom='$genre2')
                                    AND A.id IN ( SELECT DISTINCT anime_id FROM anime_genre INNER JOIN genre ON(anime_genre.genre_id=genre.id)
                                    WHERE genre.nom='$genre3') AND A.id IN ( SELECT DISTINCT anime_id FROM anime_genre INNER JOIN genre 
                                    ON(anime_genre.genre_id=genre.id) WHERE genre.nom='$genre4')";
                    if(isset($_GET['genre5'])){
                        $genre5 = $_GET['genre5'];
                        $animerequest = "SELECT A.id, A.nom, A.nb_ep, A.nb_oav, A.nb_film, A.note, A.img FROM anime A WHERE A.id IN 
                                        ( SELECT DISTINCT anime_id FROM anime_genre INNER JOIN 
                                        genre ON(anime_genre.genre_id=genre.id) WHERE genre.nom='$genre1') AND A.id IN ( SELECT DISTINCT anime_id
                                        FROM anime_genre INNER JOIN genre ON(anime_genre.genre_id=genre.id) WHERE genre.nom='$genre2')
                                        AND A.id IN ( SELECT DISTINCT anime_id FROM anime_genre INNER JOIN genre ON(anime_genre.genre_id=genre.id)
                                        WHERE genre.nom='$genre3') AND A.id IN ( SELECT DISTINCT anime_id FROM anime_genre INNER JOIN genre 
                                        ON(anime_genre.genre_id=genre.id) WHERE genre.nom='$genre4') AND A.id IN ( SELECT DISTINCT anime_id FROM anime_genre 
                                        INNER JOIN genre ON(anime_genre.genre_id=genre.id) WHERE genre.nom='$genre5')";
                    }
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AnimeList</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/animelist.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="jquery.autocomplete.min.js"></script>
    <script>
        function insertli(value){
            return "<li class='link-decoration'><input class='temp' type='hidden'><span class='autowidth tempo name'>" +
                "" + value + "</span></li>"
        }
        $(document).ready(function() {
            var i = 1;
            $('.genreitemlink').click(function() {
                var value = $(this).html();
                var name = 'genre' + i;
                var id = 'n' + i;
                if(name != 'genre6'){
                    $('#choices-choosen').append(insertli(value));
                    $('.temp').attr('name', name);
                    $('.temp').attr('value', value);
                    $('.tempo').attr('id', id);
                    $('.tempo').removeClass('tempo');
                    $('.temp').removeAttr('class');
                    i = i+1;
                    $(this).css({
                        "cursor": "default",
                        "color": "grey",
                        "background-color": "lightgray",
                        "pointer-events": "none"
                    });
                }
                else{
                    // On affiche le message
                    document.getElementById('error').innerHTML = "5 genres maximum";

                    // On l'efface 8 secondes plus tard
                    setTimeout(function() {
                        document.getElementById('error').innerHTML = "";
                    },3000);
                }
            });
            $("#recherche").autocomplete({
                source: "ajax_php/rechercheajax.php",
                minLength: 2,
                select: function(event, ui) {
                    $('#recherche').attr('value', $(this).html());
                }
            });
            $('#returntop').click(function () {
                $('html, body').animate({scrollTop:0}, 'slow');
                return false;
            });
        });
        function request(texte)
        {
            var name = document.getElementById('recherche').value;
            $.ajax({
                type: "POST",
                url: "ajax_php/dynamicresearch.php",
                data: {name: name}, // je passe la variable JS
                success: function(msg){ // je récupère la réponse dans la variable msg
                    $('#contenant').empty();
                    $('#contenant').append(msg);
                    $('html').css('height', '100%');
                }

            });
        }
        $('.ui-menu-item').click(function () {
            var e = jQuery.Event("keydown");
            e.which = 13; // # Some key code value
            e.keyCode = 13;
            $("input").trigger(e);
        });
        $(document).on('click', '.name', function() {
            var txt = $(this).html();
            var selector = ".genreitemlink:contains("+ txt +")";
            $(selector).css({
                "cursor": "pointer",
                "color": "black",
                "background-color": "white",
                "pointer-events": "auto"
            });
            $(this).parent().remove();
        });
    </script>
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
            <ul class="nav navbar-nav ariane">
                <?php
                define('NOM_SITE', 'AnimeList', true);
                get_fil_ariane(array('final' => 'Animes'));
                ?>
            </ul>
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
    <?php
        if(isset($_GET['addanime']) == 1){
            echo "<div class=\"alert alert-success alert-dismissable\">
            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
            Anime ajouté</div>";
        }
        if(isset($_GET['successcsv']) == 1){
            echo "<div class=\"alert alert-success alert-dismissable\">
                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                Animes ajoutés</div>";
        }
        if(isset($_GET['delete']) == 1){
            echo "<div class=\"alert alert-danger alert-dismissable\">
            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
            Anime supprimé</div>";
        }
        if(isset($_GET['editanime']) == 1){
        echo "<div class=\"alert alert-success alert-dismissable\">
            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
            Anime modifié</div>";
        }
    ?>
    <div class="container margin-top col-md-9">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php
                    if (isset($_SESSION['login']) AND isset($_SESSION['access'])){
                        echo"
                         <div style='height:50px; line-height:50px;' class=\"row\">
                            <div style='padding-left: 20px;' class=\"pull-left\"><h3>Liste d'anime</h3></div>
                            <div style='padding-right:20px; vertical-align: middle;' class=\"pull-right\">
                                <a href='entity_add/addanime.php'><button type=\"button\" class=\"btn btn-success\">Ajouter un anime</button></a>
                            </div>
                        </div>";
                    }
                    else{
                        echo "<h3>Liste d'anime</h3>";
                    }
                ?>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th><a href="animelist.php?sort=nom">Anime</a></th>
                                <th style='text-align:center'>Genre</th>
                                <th style='text-align:center'><a href="animelist.php?sort=ep">Épisodes</a></th>
                                <th style='text-align:center'><a href="animelist.php?sort=oav">OAV</a></th>
                                <th style='text-align:center'><a href="animelist.php?sort=film">Films</a></th>
                                <th style='text-align:center'><a href="animelist.php?sort=note">Note</a></th>
                            </tr>
                        </thead>
                        <tbody id="contenant">
                            <?php
                                $animeresult = $db->selectRequest($animerequest);
                                foreach($animeresult as $row){
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
                                            $txtcolor = '#FF6E00';
                                            break;
                                        case 7:
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
                                    echo "
                                    <tr class='handcursor' onclick='document.location.href=\"animedetail.php?id=".$id."\"'>
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
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container margin-top col-md-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>Filtres</h3>
            </div>
            <div class="panel-body">
                <h4>Genres (MAX : 5)</h4>
                <hr/>
                <form method="GET">
                    <div style="margin-bottom:10px;" class="container-fluid">
                        <div id="error"></div>
                        <div class="row">
                            <div id="choices-choosen" class="col-md-8"></div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <input style="width:175px;" type="text" data-toggle="dropdown" placeholder="Sélectionnez un genre">
                        <input style='margin-left:20px;' type='submit' class='btn-success' value='Filtrer'>
                        <ul style='width:175px; margin-top:0px; border-top-left-radius:0px; border-top-right-radius:0px;' class="dropdown-menu scrollable-menu">
                            <?php
                                $selectgenreresult = $db->selectRequest($selectgenrerequest);
                                foreach($selectgenreresult as $row){
                                    echo "<li class='genreitem' id='".$row['id']."'><a class='genreitemlink' style='cursor:pointer;'>".$row['nom']."</a></li>";
                                }
                            ?>
                        </ul>
                    </div>
                </form>
                <hr/>
                <input name="search" type="text" id="recherche" placeholder="Recherche" onkeyup='request()'/>
            </div>
        </div>
    </div>
    <div id="returntop" >Haut de page</div>
</body>
</html>
