<?php
    include 'db.php';
    include 'fil_ariane.php';
    $db = new DB();

    session_start();
    if (isset($_SESSION['access'])){
        $access = $_SESSION['access'];
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $animerequest = "SELECT * FROM anime WHERE id=$id";
        $animeresult = $db->selectRequest($animerequest);
        foreach($animeresult as $row){
            $this_id = $row['id'];
            $this_nom = $row['nom'];
            $this_auteur = $row['Auteur'];
            $this_studio = $row['Studio'];
            $this_synopsis = $row['synopsis'];
            $this_note = $row['note'];
            $this_ep = $row['nb_ep'];
            $this_oav = $row['nb_oav'];
            $this_film = $row['nb_film'];
            $this_imgurl = $row['img'];
            $this_largeimgurl = $row['imglarge'];
            $this_watching = $row['watching'];
        }
    }

    $id = isset($_POST['id']) ? htmlentities($_POST['id']) : '';
    $nom = isset($_POST['nom']) ? htmlentities($_POST['nom']) : '';
    $auteur = isset($_POST['auteur']) ? htmlentities($_POST['auteur']) : '';
    $studio = isset($_POST['studio']) ? htmlentities($_POST['studio']) : '';
    $ep = isset($_POST['ep']) ? htmlentities($_POST['ep']) : '';
    $oav = isset($_POST['oav']) ? htmlentities($_POST['oav']) : '';
    $film = isset($_POST['film']) ? htmlentities($_POST['film']) : '';
    $note = isset($_POST['note']) ? htmlentities($_POST['note']) : '';
    $synopsis = isset($_POST['synopsis']) ? htmlentities($_POST['synopsis']) : '';
    $watching = isset($_POST['watching']) ? htmlentities($_POST['watching']) : '';
    if($watching == 'Terminé'){
        $watching = 0;
    }else if($watching == 'Termin&eacute;') {
        $watching = 0;
    }else if($watching == 'En cours'){
        $watching = 1;
    }

    if(isset($_POST['nom'])){
        try{
            $db->updateAnime($nom,$ep,$oav,$film,$note,$synopsis,$auteur,$studio,$watching, $id);
            header('location:animelist.php?editanime=1');
        }catch(Exception $e){
            echo $e->getMessage();
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
                <li><a href="animelist.php">Animes</a></li>
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
                get_fil_ariane(array('animelist.php' => 'Animes', 'animedetail.php?id='.$this_id.'' => 'Détail de l\'anime', 'final' => 'Modifier un anime'));
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
    <div class='background' style="background-image:url(<?php echo $this_largeimgurl ?>);">
    <div class="container margin-top">
        <div class="panel panel-primary">
            <div class="panel-heading"><h1>Modifier un anime</h1></div>
            <div class="panel-body">
                <div class="container-fluid">
                    <form method="POST" enctype="multipart/form-data" id="addanimeform" action="editanime.php">
                        <input type="hidden" name="id" value="<?php echo $this_id ?>">
                        <div class="row">
                            <div class="col-md-4 margintb">Nom </div>
                            <div class="col-md-8 nopaddinglf margintb"><input type='text' name='nom' value="<?php echo $this_nom; ?>" required></div>
                        </div>
                        <div style="margin-top:5px;" class="row">
                            <div class="col-md-4 margintb">Auteur </div>
                            <div class="col-md-8 nopaddinglf margintb"><input type='text' name='auteur' value="<?php echo $this_auteur; ?>" required></div>
                        </div>
                        <div style="margin-top:5px;" class="row">
                            <div class="col-md-4 margintb">Studio </div>
                            <div class="col-md-8 nopaddinglf margintb"><input type='text' name='studio' value="<?php echo $this_studio; ?>" required></div>
                        </div>
                        <div style="margin-top:5px;" class="row">
                            <div class="col-md-4 margintb">Nombre d'épisodes </div>
                            <div class="col-md-8 nopaddinglf margintb"><input type='number' name='ep' value="<?php echo $this_ep; ?>" required></div>
                        </div>
                        <div style="margin-top:5px;" class="row">
                            <div class="col-md-4 margintb">Nombre d'OAV </div>
                            <div class="col-md-8 nopaddinglf margintb"><input type='number' name='oav' value="<?php echo $this_oav; ?>" required></div>
                        </div>
                        <div style="margin-top:5px;" class="row">
                            <div class="col-md-4 margintb">Nombre de films </div>
                            <div class="col-md-8 nopaddinglf margintb"><input type='number' name='film' value="<?php echo $this_film; ?>" required></div>
                        </div>
                        <div style="margin-top:5px;" class="row">
                            <div class="col-md-4 margintb">Note </div>
                            <div class="col-md-8 nopaddinglf margintb"><input type='number' name='note' value="<?php echo $this_note; ?>" required> / 10</div>
                        </div>
                        <div style="margin-top:5px;" class="row">
                            <div class="col-md-4">Synopsis </div>
                            <textarea class="col-md-8 margintb nopaddinglf" style="resize:none; height:100px; width:400px; padding:5px;" name="synopsis" form="addanimeform" required><?php echo $this_synopsis; ?></textarea>
                        </div>
                        <div style="margin-top:5px;" class="row">
                            <div class="col-md-4 margintb">Statut </div>
                            <select name="watching" from="addanimeform" required>
                                <?php
                                    if($this_watching == 0){
                                        echo "<option selected='selected'>Terminé</option>
                                              <option>En cours</option>";
                                    }else{
                                        echo "<option>Terminé</option>
                                              <option selected='selected'>En cours</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div style="margin-top:20px;" class="row">
                            <div style="text-align:center;" class="col-md-12"><input type='submit' class='btn-success' value='Modifier'></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
