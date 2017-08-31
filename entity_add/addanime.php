<?php
    include '../db.php';
    include '../fil_ariane.php';
    $db = new DB();

    session_start();
if (isset($_SESSION['access'])){
    $access = $_SESSION['access'];
}

    $genrerequest = "SELECT id, nom FROM genre";
    $query = "SELECT genre.id FROM genre;";
    $result = $db->selectRequest($query);

    $genreids = array();
    foreach ($result as $row) {
        $genreids[] = $row['id'];
    }

    function getGenreId($genrename, $genreids){
        $genreid = 0;
        switch ($genrename){
            case 'ACTION':
                $genreid = $genreids[0];
                break;
            case 'AVENTURE':
                $genreid = $genreids[1];
                break;
            case 'AMOUR ET AMITIE':
                $genreid = $genreids[2];
                echo $genreid;
                break;
            case 'COMBAT':
                $genreid = $genreids[3];
                break;
            case 'COMEDIE':
                $genreid = $genreids[4];
                echo $genreid;
                break;
            case 'CYBER ET MECHA':
                $genreid = $genreids[5];
                break;
            case 'DRAME':
                $genreid = $genreids[6];
                break;
            case 'ECCHI':
                $genreid = $genreids[7];
                break;
            case 'ENIGME ET POLICIER':
                $genreid = $genreids[8];
                break;
            case 'EPIQUE ET HEROIQUE':
                $genreid = $genreids[9];
                break;
            case 'SCIENCE-FICTION':
                $genreid = $genreids[10];
                break;
            case 'FANTASTIQUE':
                $genreid = $genreids[11];
                break;
            case 'HORREUR':
                $genreid = $genreids[12];
                break;
            case 'MAGICAL GIRL':
                $genreid = $genreids[13];
                break;
            case 'MUSICAL':
                $genreid = $genreids[14];
                break;
            case 'SPORT':
                $genreid = $genreids[15];
                break;
            case 'TRANCHE DE VIE':
                $genreid = $genreids[16];
                echo $genreid;
                break;
            default:
                break;
        }
        return $genreid;
    }

    $nom = isset($_POST['nom']) ? htmlentities($_POST['nom']) : '';
    $auteur = isset($_POST['auteur']) ? htmlentities($_POST['auteur']) : '';
    $studio = isset($_POST['studio']) ? htmlentities($_POST['studio']) : '';
    $ep = isset($_POST['ep']) ? htmlentities($_POST['ep']) : '';
    $oav = isset($_POST['oav']) ? htmlentities($_POST['oav']) : '';
    $film = isset($_POST['film']) ? htmlentities($_POST['film']) : '';
    $note = isset($_POST['note']) ? htmlentities($_POST['note']) : '';
    $watching = isset($_POST['watching']) ? htmlentities($_POST['watching']) : '';
    if($watching == 'Terminé'){
        $watching = 0;
    }else if($watching == 'Termin&eacute;') {
        $watching = 0;
    }else if($watching == 'En cours'){
        $watching = 1;
    }
    $pref = isset($_POST['pref']) ? htmlentities($_POST['pref']) : '';
    $synopsis = isset($_POST['synopsis']) ? htmlentities($_POST['synopsis']) : '';
    $genre1 = isset($_POST['genre1']) ? htmlentities($_POST['genre1']) : '';
    $genre2 = isset($_POST['genre2']) ? htmlentities($_POST['genre2']) : '';
    $genre3 = isset($_POST['genre3']) ? htmlentities($_POST['genre3']) : '';
    $genre4 = isset($_POST['genre4']) ? htmlentities($_POST['genre4']) : '';
    $genre5 = isset($_POST['genre5']) ? htmlentities($_POST['genre5']) : '';
    $uploaddir = 'F:\wamp64\www\animelist\images\'';
    $error = 0;

    if(isset($_POST['nom'])){
        $uploadfile = $uploaddir.($_FILES['smallimg']['name']);
        $uploadlargefile = $uploaddir.($_FILES['largeimg']['name']);
        $img = "images/".($_FILES['smallimg']['name']);
        $largeimg = "images/".($_FILES['largeimg']['name']);
        if (move_uploaded_file($_FILES['smallimg']['tmp_name'], $uploadfile) && move_uploaded_file($_FILES['largeimg']['tmp_name'], $uploadlargefile)) {
            $req = $db->selectRequest("select anime.nom from anime where anime.nom='$nom'");
            if($req->rowCount()) {
                $error = 2;
            }
            else {
                if($pref == 'Oui'){
                    $db->insertAnimePref($nom,$ep,$oav,$film,$note,$synopsis,$auteur,$studio,$img,$largeimg,$watching);
                    $thisanimerequest = ("SELECT id FROM anime WHERE nom LIKE '$nom'");
                    $thisanimeresult = $db->selectRequest($thisanimerequest);
                    foreach($thisanimeresult as $row){
                        $thisid = $row['id'];
                    }
                    $db->insertAnimeSeason($thisid);
                }else{
                    $db->insertAnime($nom,$ep,$oav,$film,$note,$synopsis,$auteur,$studio,$img,$largeimg,$watching);
                }
                $animerequest = "SELECT id FROM anime WHERE anime.nom='$nom'";
                $animeresult = $db->selectRequest($animerequest);
                foreach($animeresult as $row){
                    $animeid = $row['id'];
                }
                if($genre1 != "" && $genre2 != ""){
                    $genreid = getGenreId($genre1, $genreids);
                    $db->insertAnimeGenre($animeid,$genreid);
                    $genreid = getGenreId($genre2, $genreids);
                    $db->insertAnimeGenre($animeid,$genreid);
                    if($genre3 != ""){
                        $genreid = getGenreId($genre3, $genreids);
                        $db->insertAnimeGenre($animeid,$genreid);
                        if($genre4 != ""){
                            $genreid = getGenreId($genre4, $genreids);
                            $db->insertAnimeGenre($animeid,$genreid);
                            if($genre5 != ""){
                                $genreid = getGenreId($genre5, $genreids);
                                $db->insertAnimeGenre($animeid,$genreid);
                            }
                        }
                    }
                }
                header('location:../animelist.php?addanime=1');
            }
        }
        else{
            $error = 1;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AnimeList</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/animelist.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../index.php">AnimeList</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="../animelist.php">Animes</a></li>
                <li><a href="../ost.php">Classement OST</a></li>
            </ul>
            <form method="get" action="../search.php" class="navbar-form navbar-left">
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
                get_fil_ariane(array('../animelist.php' => 'Animes', 'final' => 'Ajouter un anime'));
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if (isset($_SESSION['login']) AND isset($_SESSION['access'])){
                        echo "<li><a href=\"../log-pages/logout.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Logout</a></li>";
                    }
                    else{
                        echo"
                        <li><a href=\"../log-pages/signup.php\"><span class=\"glyphicon glyphicon-user\"></span> Sign Up</a></li>
                        <li><a href=\"../log-pages/login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
                    }
                ?>
            </ul>
        </div>
    </nav>
    <?php
        if($error == 1){
            echo "<div class=\"alert alert-danger alert-dismissable\">
                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                <strong>ERREUR ! </strong>Images non uploadées</div>";
        }
        if($error == 2){
            echo "<div class=\"alert alert-danger alert-dismissable\">
                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                <strong>ERREUR ! </strong>Il existe déjà un anime de ce nom</div>";
        }
    ?>
    <div class="container margin-top">
        <div class="panel panel-primary">
            <div class="panel-heading"><h1>Ajouter un anime</h1></div>
            <div class="panel-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5">
                            <h3>Ajout par CVS</h3>
                            <form method="post" enctype="multipart/form-data" action="addanimebycsv.php">
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Fichier CSV (ANIMES) </div>
                                    <input class="col-md-8 nopaddinglf margintb" name="csv" type="file">
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Fichier CSV (GENRES)</div>
                                    <input class="col-md-8 nopaddinglf margintb" name="csvgenre" type="file">
                                </div>
                                <div style="margin-top:20px;" class="row">
                                    <div style="text-align:center;" class="col-md-12"><input type='submit' class='btn-success' value='Ajouter'></div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-7" style="padding-left:50px; border-left:1px solid #555">
                            <h3>Ajout par champs</h3>
                            <form method="POST" enctype="multipart/form-data" id="addanimeform" action="addanime.php">
                                <div class="row">
                                    <div class="col-md-4 margintb">Nom </div>
                                    <div class="col-md-8 nopaddinglf margintb"><input type='text' name='nom' required></div>
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Auteur </div>
                                    <div class="col-md-8 nopaddinglf margintb"><input type='text' name='auteur' required></div>
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Studio </div>
                                    <div class="col-md-8 nopaddinglf margintb"><input type='text' name='studio' required></div>
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Nombre d'épisodes </div>
                                    <div class="col-md-8 nopaddinglf margintb"><input type='number' name='ep' required></div>
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Nombre d'OAV </div>
                                    <div class="col-md-8 nopaddinglf margintb"><input type='number' name='oav' required></div>
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Nombre de films </div>
                                    <div class="col-md-8 nopaddinglf margintb"><input type='number' name='film' required></div>
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Note </div>
                                    <div class="col-md-8 nopaddinglf margintb"><input type='number' name='note' required> / 10</div>
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4">Synopsis </div>
                                    <textarea class="col-md-8 margintb nopaddinglf" style="resize:none; width:275px;" name="synopsis" form="addanimeform" required></textarea>
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Statut </div>
                                    <div class="col-md-8 nopaddinglf margintb">
                                        <select name="watching" from="addanimeform" required>
                                            <option>Terminé</option>
                                            <option>En cours</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Ajouter aux préférences ? </div>
                                    <div class="col-md-8 nopaddinglf margintb">
                                        <select name="pref" from="addanimeform" required>
                                            <option>Oui</option>
                                            <option selected="selected">Non</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Image (150x150) </div>
                                    <input class="col-md-8 nopaddinglf margintb" name="smallimg" type="file" required>
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Image (1600x1000) </div>
                                    <input class="col-md-8 nopaddinglf margintb" name="largeimg" type="file" required>
                                </div>
                                <hr/>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Genres 1 </div>
                                    <div class="col-md-8 nopaddinglf margintb">
                                        <select name="genre1" from="addanimeform" required>
                                            <option></option>
                                            <?php
                                            $genreresult = $db->selectRequest($genrerequest);
                                            foreach($genreresult as $row){
                                                echo "<option>".$row['nom']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 margintb">Genres 2 </div>
                                    <div class="col-md-8 nopaddinglf margintb">
                                        <select name="genre2" from="addanimeform" required>
                                            <option></option>
                                            <?php
                                            $genreresult = $db->selectRequest($genrerequest);
                                            foreach($genreresult as $row){
                                                echo "<option>".$row['nom']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 margintb">Genres 3 </div>
                                    <div class="col-md-8 nopaddinglf margintb">
                                        <select name="genre3" from="addanimeform">
                                            <option></option>
                                            <?php
                                            $genreresult = $db->selectRequest($genrerequest);
                                            foreach($genreresult as $row){
                                                echo "<option>".$row['nom']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 margintb">Genres 4 </div>
                                    <div class="col-md-8 nopaddinglf margintb">
                                        <select name="genre4" from="addanimeform">
                                            <option></option>
                                            <?php
                                            $genreresult = $db->selectRequest($genrerequest);
                                            foreach($genreresult as $row){
                                                echo "<option>".$row['nom']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 margintb">Genres 5 </div>
                                    <div class="col-md-8 nopaddinglf margintb">
                                        <select name="genre5" from="addanimeform">
                                            <option></option>
                                            <?php
                                            $genreresult = $db->selectRequest($genrerequest);
                                            foreach($genreresult as $row){
                                                echo "<option>".$row['nom']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top:20px;" class="row">
                                    <div style="text-align:center;" class="col-md-12"><input type='submit' class='btn-success' value='Ajouter'></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
