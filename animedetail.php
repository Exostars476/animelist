<?php
    include 'db.php';
    include 'fil_ariane.php';
    $db = new DB();

    session_start();
    if (isset($_SESSION['access'])){
        $access = $_SESSION['access'];
    }


    if(isset($_GET['deleteid'])){
        try{
            $id = $_GET['deleteid'];
            $db->deleteAnime($id);
            header('location:animelist.php?delete=1');
        }
        catch(Exception $e){
            header('location:animedetail.php?error=1&msg=".$e->getMessage()."');
        }
    }

    $id = $_GET['id'];
    $animerequest = "SELECT * FROM anime WHERE id=$id";
    $animeresult = $db->selectRequest($animerequest);
    foreach($animeresult as $row){
        $id = $row['id'];
        $nom = $row['nom'];
        $auteur = $row['Auteur'];
        $studio = $row['Studio'];
        $synopsis = $row['synopsis'];
        $note = $row['note'];
        $ep = $row['nb_ep'];
        $oav = $row['nb_oav'];
        $film = $row['nb_film'];
        $imgurl = $row['img'];
        $largeimgurl = $row['imglarge'];
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
                get_fil_ariane(array('animelist.php' => 'Animes', 'final' => 'Détail de l\'anime'));
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
    <div class='background' style="background-image:url(<?php echo $largeimgurl ?>);">
        <div class="container margin-top">
            <div class="panel panel-primary" style="background-color: rgba(255, 255, 255, 0.9);">
                <div class="panel-heading">
                    <?php
                    if (isset($_SESSION['login']) AND isset($_SESSION['access'])){
                        echo"
                         <div style='height:50px; line-height:50px;' class=\"row\">
                            <div style='padding-left: 20px;' class=\"pull-left\"><h1>".$nom."</h1></div>
                            <div style='padding-right:20px; vertical-align: middle;' class=\"pull-right\">
                                <a href='editanime.php?id=".$id."'><button type=\"button\" class=\"btn btn-info\">Modifier l'anime</button></a>
                                <a href='animedetail.php?deleteid=".$id."'><button type=\"button\" class=\"btn btn-danger\">Supprimer l'anime</button></a>
                            </div>
                        </div>";
                    }
                    else{
                        echo "<h1>".$nom."</h1>";
                    }
                    ?>

                </div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 content"><span class="spantitle">Auteur : </span><?php echo $auteur ?></div>
                            <div class="col-md-6 content"><span class="spantitle">Studio : </span><?php echo $studio ?></div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12"><span class="spantitle">Synopsis</span><p style="margin-top:20px;"><?php echo $synopsis ?></p></div>
                        </div>
                        <hr/>
                        <div class="row detail-footer">
                            <div class="col-md-3" style="border-right:1px solid lightgray;">Note : <?php echo $note ?> / 10</div>
                            <div class="col-md-3" style="border-right:1px solid lightgray;">Episode : <?php echo $ep ?></div>
                            <div class="col-md-3" style="border-right:1px solid lightgray;">OAV : <?php echo $oav ?></div>
                            <div class="col-md-3">Film : <?php echo $film ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>