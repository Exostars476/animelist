<?php
    include '../db.php';
    include '../fil_ariane.php';
    $db = new DB();

    session_start();
    $access = $_SESSION['access'];

    $animerequest = "SELECT nom FROM anime ORDER BY nom";

    $nom = isset($_POST['nom']) ? htmlentities($_POST['nom']) : '';
    $auteur = isset($_POST['auteur']) ? htmlentities($_POST['auteur']) : '';
    $note = isset($_POST['note']) ? htmlentities($_POST['note']) : '';
    if($note == 0){
        $note = NULL;
    }
    if (isset($_POST['type'])){
        switch($_POST['type']){
            case 'Opening':
                $typeost = 'opening';
                break;
            case 'Ending':
                $typeost = 'ending';
                break;
            case 'OST':
                $typeost = 'ost';
                break;
            default:
                $typeost = 'unknow';
                break;
        }
    }


    if(isset($_POST['nom'])){
        $anime_name = $_POST['anime'];
        $animeidrequest = "SELECT id FROM anime WHERE nom LIKE '$anime_name'";
        $animeidresult = $db->selectRequest($animeidrequest);
        foreach($animeidresult as $row){
            $animeid = $row['id'];
        }
        try{
            $db->insertOST($typeost, $nom, $auteur, $note, $animeid);
            header('location:../ost.php?success=1');
        }catch(Exception $e){
            echo "type ost = ".$_POST['type']."<br/>typeost = ".$typeost. "<br/>nom = ".$nom.
                "<br/>auteur = ".$auteur. "<br/>note = ".$note. "<br/>animeid = ".$animeid."<br/>anime_name = ".$anime_name;
        }
    }

?>

<!DOCTYPE html>
<html lang="en" style="height:100%;">
<head>
    <meta charset="UTF-8">
    <title>AnimeList</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/animelist.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#myTab a").click(function(e){
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>
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
                get_fil_ariane(array('../ost.php' => 'Classement OST', 'final' => 'Ajouter une OST'));
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
        if(isset($_GET['error']) == 1){
            echo "<div class=\"alert alert-danger alert-dismissable\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                    <strong>ERREUR ! </strong>".$_GET['msg']."</div>";
        }
    ?>
    <div style="width:600px;" class="container margin-top">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1>Ajouter une OST</h1>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div id="opsection" class="tab-pane fade in active">
                        <div class="container-fluid">
                            <h3>Ajout par CVS</h3>
                            <form method="post" enctype="multipart/form-data" action="addostbycsv.php">
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Fichier CSV (OST) </div>
                                    <input class="col-md-8 nopaddinglf margintb" name="csv" type="file">
                                </div>
                                <div style="margin-top:20px;" class="row">
                                    <div style="text-align:center;" class="col-md-12"><input type='submit' class='btn-success' value='Ajouter'></div>
                                </div>
                            </form>
                            <hr/>
                            <h3>Ajout par champs</h3>
                            <form method="POST" id="addostform" action="addost.php" novalidate>
                                <div class="row">
                                    <div class="col-md-4 margintb">Type </div>
                                    <div class="col-md-8 nopaddinglf margintb">
                                        <select name="type" form="addostform" required>
                                            <option></option>
                                            <option>Opening</option>
                                            <option>Ending</option>
                                            <option>OST</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 margintb">Nom </div>
                                    <div class="col-md-8 nopaddinglf margintb"><input type='text' name='nom' required></div>
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Auteur </div>
                                    <div class="col-md-8 nopaddinglf margintb"><input type='text' name='auteur' required></div>
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Note </div>
                                    <div class="col-md-8 nopaddinglf margintb"><input type='number' name='note'> / 100</div>
                                </div>
                                <div style="margin-top:5px;" class="row">
                                    <div class="col-md-4 margintb">Anime </div>
                                    <div class="col-md-8 nopaddinglf margintb">
                                        <select name="anime" form="addostform" required>
                                            <option></option>
                                            <?php
                                                $animeresult = $db->selectRequest($animerequest);
                                                foreach($animeresult as $row){
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
