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
        $animerequest = "SELECT id, nom FROM anime ORDER BY nom";
        $ostrequest = "SELECT * FROM ost WHERE id=$id";
        $ostresult = $db->selectRequest($ostrequest);
        foreach($ostresult as $row){
            $actual_nom = $row['titre'];
            $actual_auteur = $row['auteur'];
            $actual_note = $row['note'];
            $actual_anime_id = $row['anime_id'];
            $actual_type = $row['type_ost'];
        }
    }

    $ostid = isset($_POST['ostid']) ? htmlentities($_POST['ostid']) : '';
    $nom = isset($_POST['nom']) ? htmlentities($_POST['nom']) : '';
    $auteur = isset($_POST['auteur']) ? htmlentities($_POST['auteur']) : '';
    $note = isset($_POST['note']) ? htmlentities($_POST['note']) : '';
    if($note == 0){
        $note = NULL;
    }
    $type_ost = isset($_POST['type']) ? htmlentities($_POST['type']) : '';
    if(isset($_POST['anime'])){
        $anime_name = $_POST['anime'];
        $animeidrequest = "SELECT id FROM anime WHERE nom='$anime_name'";
        $animeidresult = $db->selectRequest($animeidrequest);
        foreach($animeidresult as $row){
            $animeid = $row['id'];
        }
        try{
            $db->updateOST($type_ost, $nom, $auteur, $note, $animeid, $ostid);
            header('location:ost.php?success=2');
        }catch(Exception $e){
            $msg = $e->getMessage();
            header('location:editost.php?error=1&msg=".$msg."');
        }
    }
?>

<!DOCTYPE html>
<html lang="en" style='height:100%;'>
<head>
    <meta charset="UTF-8">
    <title>AnimeList</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/animelist.css">
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
                get_fil_ariane(array('ost.php' => 'Classement OST', 'final' => 'Modifier une OST'));
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
        if(isset($_GET['error']) == 1){
            echo "<div class=\"alert alert-danger alert-dismissable\">
                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                        <strong>ERREUR ! </strong>".$_GET['msg']."</div>";
        }
    ?>
    <div style="width:600px;" class="container margin-top">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php
                    switch($actual_type){
                        case 'opening':
                            echo "<h1>Modifier un Opening</h1>";
                            break;
                        case 'ending':
                            echo "<h1>Modifier un Ending</h1>";
                            break;
                        case 'ost':
                            echo "<h1>Modifier une OST</h1>";
                            break;
                        default:
                            echo "<h1>Modifier</h1>";
                            break;
                    }
                ?>
            </div>
            <div class="panel-body">
                <?php
                    switch($actual_type){
                        case 'opening':
                            echo "
                            <div class=\"container-fluid\">
                                <form method=\"POST\" enctype=\"multipart/form-data\" id=\"editostform\" action=\"editost.php\">
                                    <div class=\"row\">
                                        <div class=\"col-md-4 margintb\">Nom </div>
                                        <div class=\"col-md-8 nopaddinglf margintb\"><input type='text' name='nom' value='$actual_nom' required></div>
                                    </div>
                                    <div style=\"margin-top:5px;\" class=\"row\">
                                        <div class=\"col-md-4 margintb\">Auteur </div>
                                        <div class=\"col-md-8 nopaddinglf margintb\"><input type='text' name='auteur' value='$actual_auteur' required></div>
                                    </div>
                                    <div style=\"margin-top:5px;\" class=\"row\">
                                        <div class=\"col-md-4 margintb\">Note </div>
                                        <div class=\"col-md-8 nopaddinglf margintb\"><input type='number' name='note' value='$actual_note'> / 100</div>
                                    </div>
                                    <div style=\"margin-top:5px;\" class=\"row\">
                                        <div class=\"col-md-4 margintb\">Anime </div>
                                        <div class=\"col-md-8 nopaddinglf margintb\">
                                            <select name=\"anime\" form=\"editostform\" required>
                                                <option></option>";
                                                $animeresult = $db->selectRequest($animerequest);
                                                foreach($animeresult as $row){
                                                    if($row['id'] == $actual_anime_id){
                                                        echo "<option selected='selected'>".$row['nom']."</option>";
                                                    }else{
                                                        echo "<option>".$row['nom']."</option>";
                                                    }
                                                }
                                                echo "
                                            </select>
                                        </div>
                                    </div>
                                    <input type=\"hidden\" name=\"type\" value=\"opening\">
                                    <input type='hidden' name='ostid' value='".$id."'>
                                    <div style=\"margin-top:20px;\" class=\"row\">
                                        <div style=\"text-align:center;\" class=\"col-md-12\"><input type='submit' class='btn-success' value='Modifier'></div>
                                    </div>
                                </form>
                            </div>";
                            break;
                        case 'ending':
                            echo "
                            <div class=\"container-fluid\">
                                <form method=\"POST\" enctype=\"multipart/form-data\" id=\"editostform\" action=\"editost.php\">
                                    <div class=\"row\">
                                        <div class=\"col-md-4 margintb\">Nom </div>
                                        <div class=\"col-md-8 nopaddinglf margintb\"><input type='text' value='$actual_nom' name='nom' required></div>
                                    </div>
                                    <div style=\"margin-top:5px;\" class=\"row\">
                                        <div class=\"col-md-4 margintb\">Auteur </div>
                                        <div class=\"col-md-8 nopaddinglf margintb\"><input type='text' name='auteur' value='$actual_auteur' required></div>
                                    </div>
                                    <div style=\"margin-top:5px;\" class=\"row\">
                                        <div class=\"col-md-4 margintb\">Note </div>
                                        <div class=\"col-md-8 nopaddinglf margintb\"><input type='number' name='note' value='$actual_note'> / 100</div>
                                    </div>
                                    <div style=\"margin-top:5px;\" class=\"row\">
                                        <div class=\"col-md-4 margintb\">Anime </div>
                                        <div class=\"col-md-8 nopaddinglf margintb\">
                                            <select name=\"anime\" form=\"editostform\" required>
                                                <option></option>";
                                                $animeresult = $db->selectRequest($animerequest);
                                                foreach($animeresult as $row){
                                                    if($row['id'] == $actual_anime_id){
                                                        echo "<option selected='selected'>".$row['nom']."</option>";
                                                    }else{
                                                        echo "<option>".$row['nom']."</option>";
                                                    }
                                                }
                                                echo"
                                            </select>
                                        </div>
                                    </div>
                                    <input type=\"hidden\" name=\"type\" value=\"ending\">
                                    <input type='hidden' name='ostid' value='".$id."'>
                                    <div style=\"margin-top:20px;\" class=\"row\">
                                        <div style=\"text-align:center;\" class=\"col-md-12\"><input type='submit' class='btn-success' value='Modifier'></div>
                                    </div>
                                </form>
                            </div>";
                            break;
                        case 'ost':
                            echo "
                            <div class=\"container-fluid\">
                                <form method=\"POST\" enctype=\"multipart/form-data\" id=\"editostform\" action=\"editost.php\">
                                    <div class=\"row\">
                                        <div class=\"col-md-4 margintb\">Nom </div>
                                        <div class=\"col-md-8 nopaddinglf margintb\"><input type='text' name='nom' value='$actual_nom' required></div>
                                    </div>
                                    <div style=\"margin-top:5px;\" class=\"row\">
                                        <div class=\"col-md-4 margintb\">Auteur </div>
                                        <div class=\"col-md-8 nopaddinglf margintb\"><input type='text' name='auteur' value='$actual_auteur' required></div>
                                    </div>
                                    <div style=\"margin-top:5px;\" class=\"row\">
                                        <div class=\"col-md-4 margintb\">Note </div>
                                        <div class=\"col-md-8 nopaddinglf margintb\"><input type='number' name='note' value='$actual_note'> / 100</div>
                                    </div>
                                    <div style=\"margin-top:5px;\" class=\"row\">
                                        <div class=\"col-md-4 margintb\">Anime </div>
                                        <div class=\"col-md-8 nopaddinglf margintb\">
                                            <select name=\"anime\" form=\"editostform\" required>
                                                <option></option>";
                                                $animeresult = $db->selectRequest($animerequest);
                                                foreach($animeresult as $row){
                                                    if($row['id'] == $actual_anime_id){
                                                        echo "<option selected='selected'>".$row['nom']."</option>";
                                                    }else{
                                                        echo "<option>".$row['nom']."</option>";
                                                    }
                                                }
                                                echo"
                                            </select>
                                        </div>
                                    </div>
                                    <input type=\"hidden\" name=\"type\" value=\"ost\">
                                    <input type='hidden' name='ostid' value='".$id."'>
                                    <div style=\"margin-top:20px;\" class=\"row\">
                                        <div style=\"text-align:center;\" class=\"col-md-12\"><input type='submit' class='btn-success' value='Modifier'></div>
                                    </div>
                                </form>
                            </div>";
                            break;
                        default:
                            echo "<h1>Modifier</h1>";
                            break;
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
