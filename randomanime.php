<?php
    include 'db.php';
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
    <script>
        function genAnime(){
            $.ajax({
                url : 'ajax_php/randomanime.php',
                type : 'POST',
                dataType : 'json',
                success : function (result) {
                    $('#img').css('background-image','url(result[\'img\'])');
                }
            });
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
                <li class="active"><a href="index.php">Accueil</a></li>
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
    <div class="container" style="text-align:center; margin-top:20%;">
        <div id="animerandom" style="margin:0px auto 20px auto; height:300px; width:250px; border:1px solid black;">
            <div id="img">
                <div class="divanimetitle"><span id="title" style="font-size:20px;"></span></div>
            </div>
        </div>
        <button id="generate-anime" class="btn btn-info" onclick="genAnime();">Générer</button>
    </div>
</body>
</html>