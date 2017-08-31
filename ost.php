<?php
    include 'db.php';
    include 'fil_ariane.php';
    $db = new DB();

    session_start();
    if (isset($_SESSION['access'])){
        $access = $_SESSION['access'];
    }
    $success = isset($_GET['success']) ? htmlentities($_GET['success']) : '';

    if(isset($_GET['deleteid'])){
        $deleteid = $_GET['deleteid'];
        try{
            $db->deleteOST($deleteid);
            header('location:ost.php?delete=1');
        }
        catch(Exception $e){
            header('location:animedetail.php?error=1&msg=".$e->getMessage()."');
        }
    }

    if(isset($_GET['sort'])){
        switch ($_GET['sort']){
            case 'nom':
                $openingrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                                   WHERE type_ost='opening' ORDER BY titre;";
                $endingrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                                  WHERE type_ost='ending' ORDER BY titre;";
                $ostrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                               WHERE type_ost='ost' ORDER BY titre;";
                break;
            case 'auteur':
                $openingrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                                   WHERE type_ost='opening' ORDER BY ost.auteur;";
                $endingrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                                  WHERE type_ost='ending' ORDER BY ost.auteur;";
                $ostrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                               WHERE type_ost='ost' ORDER BY ost.auteur;";
                break;
            case 'anime':
                $openingrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                                   WHERE type_ost='opening' ORDER BY nom;";
                $endingrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                                  WHERE type_ost='ending' ORDER BY nom;";
                $ostrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                               WHERE type_ost='ost' ORDER BY nom;";
                break;
            case 'note':
                $openingrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                                   WHERE type_ost='opening' ORDER BY ost.note;";
                $endingrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                                  WHERE type_ost='ending' ORDER BY ost.note;";
                $ostrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                               WHERE type_ost='ost' ORDER BY ost.note;";
                break;
            default:
                $openingrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                                   WHERE type_ost='opening' ORDER BY ost.note;";
                $endingrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                                  WHERE type_ost='ending' ORDER BY ost.note;";
                $ostrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                               WHERE type_ost='ost' ORDER BY ost.note;";
                break;
        }
    }
    else {
        $openingrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                                   WHERE type_ost='opening' ORDER BY ost.note;";
        $endingrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                                  WHERE type_ost='ending' ORDER BY ost.note;";
        $ostrequest = "SELECT ost.id as ostid, type_ost, titre, ost.auteur, ost.note, nom, anime.id as animeid FROM ost INNER JOIN anime ON(anime.id = ost.anime_id) 
                               WHERE type_ost='ost' ORDER BY ost.note;";
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
        function confirmation(){
            return confirm("Souhaitez-vous vraiment supprimer l'ost ?");
        }
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
                <li class="active"><a href="ost.php">Classement OST</a></li>
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
                get_fil_ariane(array('final' => 'Classement OST'));
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
        if($success == 1){
            echo "<div class=\"alert alert-success alert-dismissable\">
            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
            OST ajoutée</div>";
        }
        if($success == 2){
            echo "<div class=\"alert alert-success alert-dismissable\">
                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                OST modifiée</div>";
        }
        if(isset($_GET['delete']) == 1){
            echo "<div class=\"alert alert-success alert-dismissable\">
                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                OST supprimée</div>";
        }
    ?>
    <div class="container margin-top col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading panel-heading-ost">

                <?php
                    if (isset($_SESSION['login']) AND isset($_SESSION['access'])){
                        echo"
                            <div style='height:50px; line-height:50px;' class=\"row\">
                                <div style='padding-right:20px;margin-bottom:5px; vertical-align: middle;' class=\"pull-right\">
                                    <a href='entity_add/addost.php'><button type=\"button\" style='margin-bottom:10px;' class=\"btn btn-success\">Ajouter une ost</button></a>
                                </div>
                                <div style='padding-left: 20px;margin-top:4px;' class=\"pull-left\">
                                    <ul class=\"nav nav-tabs\" id=\"myTab\">
                                        <li class=\"active\"><a class=\"nodeco tabs\" href=\"#opsection\">Opening</a></li>
                                        <li><a class=\"nodeco tabs\" href=\"#edsection\">Ending</a></li>
                                        <li><a class=\"nodeco tabs\" href=\"#ostsection\">OST</a></li>
                                    </ul>
                                </div>                                
                            </div>";
                    }
                    else{
                        echo "<ul class=\"nav nav-tabs\" id=\"myTab\">
                                <li class=\"active\"><a class=\"nodeco tabs\" href=\"#opsection\">Opening</a></li>
                                <li><a class=\"nodeco tabs\" href=\"#edsection\">Ending</a></li>
                                <li><a class=\"nodeco tabs\" href=\"#ostsection\">OST</a></li>
                            </ul>";
                    }
                ?>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div id="opsection" class="tab-pane fade in active">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th><a href="ost.php?sort=nom">Nom</a></th>
                                    <th style='text-align:center'><a href="ost.php?sort=auteur">Interprète</a></th>
                                    <th style='text-align:center'><a href="ost.php?sort=note">Note</a></th>
                                    <th style='text-align:center'><a href="ost.php?sort=anime">Anime</a></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $openingresult = $db->selectRequest($openingrequest);
                                    foreach($openingresult as $row){
                                        $animeid = $row['animeid'];
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
                                            <tr style='cursor:pointer;' onclick='document.location.href=\"editost.php?id=".$row['ostid']."\"'>
                                                <td class='normalsize'>".$row['titre']."</td>
                                                <td style='text-align:center' class='normalsize'>".$row['auteur']."</td>
                                                <td style='text-align:center' class='bold normalsize'>
                                                    <span style='color:".$txtcolor."' class='note'>".$row['note']."</span>
                                                    <span style='color:blue;'> /100</span>
                                                </td>
                                                <td style='text-align:center' class='normalsize'><a href='animedetail.php?id=".$animeid."'>".$row['nom']."</a></td>    
                                                <td style='text-align center; width:200px;'>
                                                    <a href='editost.php?id=".$row['ostid']."'><button class='btn btn-info'>Modifier</button></a>
                                                    <a onclick='return confirmation();' href='ost.php?deleteid=".$row['ostid']."'><button class='btn btn-danger'>Supprimer</button></a>
                                                </td>                                 
                                            </tr>";
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="edsection" class="tab-pane fade">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th><a href="ost.php?sort=nom">Nom</a></th>
                                    <th style='text-align:center'><a href="ost.php?sort=auteur">Interprète</a></th>
                                    <th style='text-align:center'><a href="ost.php?sort=note">Note</a></th>
                                    <th style='text-align:center'><a href="ost.php?sort=anime">Anime</a></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $endingresult = $db->selectRequest($endingrequest);
                                    foreach($endingresult as $row){
                                        $animeid = $row['animeid'];
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
                                            <tr style='cursor:pointer;' onclick='document.location.href=\"editost.php?id=".$row['ostid']."\"'>
                                                <td class='normalsize'>".$row['titre']."</td>
                                                <td style='text-align:center' class='normalsize'>".$row['auteur']."</td>
                                                <td style='text-align:center' class='bold normalsize'>
                                                    <span style='color:".$txtcolor."' class='note'>".$row['note']."</span>
                                                    <span style='color:blue;'> /100</span>
                                                </td>
                                                <td style='text-align:center' class='normalsize'><a href='animedetail.php?id=".$row['animeid']."'>".$row['nom']."</a></td>    
                                                <td style='text-align center; width:200px;'>
                                                    <a href='editost.php?id=".$row['ostid']."'><button class='btn btn-info'>Modifier</button></a>
                                                    <a onclick='return confirmation();' href='ost.php?deleteid=".$row['ostid']."'><button class='btn btn-danger'>Supprimer</button></a>
                                                </td>  
                                            </tr>";
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="ostsection" class="tab-pane fade">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th><a href="ost.php?sort=nom">Nom</a></th>
                                    <th style='text-align:center'><a href="ost.php?sort=auteur">Interprète</a></th>
                                    <th style='text-align:center'><a href="ost.php?sort=note">Note</a></th>
                                    <th style='text-align:center'><a href="ost.php?sort=anime">Anime</a></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $ostresult = $db->selectRequest($ostrequest);
                                    foreach($ostresult as $row){
                                        $animeid = $row['animeid'];
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
                                                <tr style='cursor:pointer;' onclick='document.location.href=\"editost.php?id=".$row['ostid']."\"'>
                                                    <td class='normalsize'>".$row['titre']."</td>
                                                    <td style='text-align:center' class='normalsize'>".$row['auteur']."</td>
                                                    <td style='text-align:center' class='bold normalsize'>
                                                        <span style='color:".$txtcolor."' class='note'>".$row['note']."</span>
                                                        <span style='color:blue;'> /100</span>
                                                    </td>
                                                    <td style='text-align:center' class='normalsize'><a href='animedetail.php?id=".$animeid."'>".$row['nom']."</a></td>  
                                                    <td style='text-align center; width:200px;'>
                                                        <a href='editost.php?id=".$row['ostid']."'><button class='btn btn-info'>Modifier</button></a>
                                                        <a onclick='return confirmation();' href='ost.php?deleteid=".$row['ostid']."'><button class='btn btn-danger'>Supprimer</button></a>
                                                    </td>                               
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
