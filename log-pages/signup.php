<?php
    include '../db.php';
    include '../fil_ariane.php';
    $db = new DB();
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
                get_fil_ariane(array('final' => 'Signup'));
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </nav>
    <?php
        if(isset($_GET['error']) == 1){
            echo "<div class=\"alert alert-danger alert-dismissable\">
                                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                    <strong>ERREUR ! </strong>Mots de passes différents</div>";
        }
        else if (isset($_GET['error']) == 2){
            echo "<div class=\"alert alert-danger alert-dismissable\">
                                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                    <strong>ERREUR ! </strong>Vous avez oublié un champ</div>";
        }
    ?>
    <div style="width:450px;" class="container margin-top">
        <div class="panel panel-primary">
            <div class="panel-heading"><h1>Inscription</h1></div>
            <div class="panel-body">
                <div class="container-fluid">
                    <form method="post" action="signupcheck.php">
                        <div class="row">
                            <div class="col-md-6">Login </div>
                            <div class="col-md-6"><input type='text' name='login' required></div>
                        </div>
                        <div style="margin-top:5px;" class="row">
                            <div class="col-md-6">Mot de passe </div>
                            <div class="col-md-6"><input type='password' name='pass' required></div>
                        </div>
                        <div style="margin-top:5px;" class="row">
                            <div class="col-md-6">Retapez le mot de passe </div>
                            <div class="col-md-6"><input type='password' name='reppass' required></div>
                        </div>
                        <div style="margin-top:20px;" class="row">
                            <div style="text-align:center;" class="col-md-12"><input type='submit' class='btn-success' value='Inscription'></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
