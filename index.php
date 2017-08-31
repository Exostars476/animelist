<?php
    include 'db.php';
    $db = new DB();

    session_start();
    if (isset($_SESSION['access'])){
        $access = $_SESSION['access'];
    }

    $animerequest = "SELECT anime.id as id, nom, img_vedette FROM anime INNER JOIN anime_season ON(anime_season.anime_id = anime.id);";
    $animeresult = $db->selectRequest($animerequest);
    $animewatching = "SELECT anime.id as id, nom, img, img_vedette FROM anime WHERE watching=1;"
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
                <li class="active"><a href="index.php">Accueil</a></li>
                <li><a href="animelist.php">Animes</a></li>
                <li><a href="ost.php">Classement OST</a></li>
                <li><a href="randomanime.php">Anime random</a></li>
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
    <?php
        if(isset($_GET['signup']) == 1){
            echo "<div class=\"alert alert-success alert-dismissable\">
            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
            Inscription réussie</div>";
        }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="padding:0 5% 0 5%;">
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="margin-bottom:20px; font-size:25px;">Préférences été 2017</h1>
                        <div id="box-anime-pref" class="container"  style="background-color:white;overflow-y:scroll;">
                            <?php
                                $i = 1;
                                echo "<div class='row'>";
                                foreach($animeresult as $row){
                                    echo
                                    "<a href='animedetail.php?id=".$row['id']."'>
                                        <div class='col-md-3' style='margin-top:20px;'>
                                            <div class='anime' style='background-image:url(".$row['img_vedette'].")';>
                                                <div class='divanimetitle'><span class='animetitle'>".$row['nom']."</span></div>
                                            </div>                                            
                                        </div>
                                    </a>";
                                }
                                echo "</div>";
                            ?>
                        </div>
                    </div>
                </div>
                <hr style="border-color:#555"/>
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="margin-bottom:20px; font-size:25px;">Anime en cours</h1>
                        <div id="box-anime-watching" class="container"  style="background-color:white;overflow-y:scroll;">
                            <?php
                            $i = 1;
                            echo "<div class='row'>";
                            $watchingresult = $db->selectRequest($animewatching);
                            foreach($watchingresult as $row){
                                echo
                                    "<a href='animedetail.php?id=".$row['id']."'>
                                        <div class='col-md-3' style='margin-top:20px;'>
                                            <div class='anime' style='background-image:url(";if(isset($row['img_vedette'])){echo $row['img_vedette'];}
                                            else{echo $row['img'];} echo ")';>
                                                <div class='divanimetitle'><span class='animetitle'>".$row['nom']."</span></div>
                                            </div>                                            
                                        </div>
                                    </a>";
                            }
                            echo "</div>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
