<?php
class DB {

    protected $db;

    public function DB(){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=animelist", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        $this->db = $conn;
    }

    public function close()
    {
        $this->db = null;
    }

        // Vérification connexion
        public function identification($login, $pass) {
            $stmt = $this->db->prepare("SELECT id FROM users WHERE login=? AND pass=?");
            $stmt->bindParam(1, $login);
            $stmt->bindParam(2, $pass);

            $stmt2 = $this->db->prepare("SELECT access FROM users WHERE login=?");
            $stmt2->bindParam(1, $login);
            $stmt2->execute();
            $access = $stmt2->fetchColumn();

            if($stmt->execute()) {
                if($stmt->rowCount()){
                    $id = $stmt->fetchColumn();
                    session_start();
                    $_SESSION['login']   = htmlentities($login);
                    $_SESSION['access'] = $access;
                    $_SESSION['id'] = $id;
                    header("Location: ../index.php");
                } else {
                    header("Location: login.php?error=1");
                }
            }
        }

        public function getAnimeByName($p1){
            $stmt = $this->db->prepare("SELECT * FROM anime WHERE nom LIKE '%?%'");
            $stmt->bindParam(1, $p1);
            $stmt->execute();
        }

        public function deleteAnime($p1){
            $stmt = $this->db->prepare("DELETE FROM anime_season WHERE anime_season.anime_id = ?;
                                        DELETE FROM anime_genre WHERE anime_genre.anime_id = ?;
                                        DELETE FROM anime WHERE anime.id = ?;");
            $stmt->bindParam(1, $p1);
            $stmt->bindParam(2, $p1);
            $stmt->bindParam(3, $p1);
            $stmt->execute();
        }

        public function deleteOST($p1){
            $stmt = $this->db->prepare("DELETE FROM ost WHERE id=?;");
            $stmt->bindParam(1, $p1);
            $stmt->execute();
        }

        public function insertUser($p1, $p2){
            $stmt = $this->db->prepare("INSERT INTO users (login, pass, access) VALUES (?,?,3)");
            $stmt->bindParam(1, $p1);
            $stmt->bindParam(2, $p2);
            $stmt->execute();
        }

        public function insertAnimeGenre($p1, $p2){
            $stmt = $this->db->prepare("INSERT INTO anime_genre (anime_id, genre_id) VALUES (?,?)");
            $stmt->bindParam(1, $p1);
            $stmt->bindParam(2, $p2);
            $stmt->execute();
        }

        public function insertOST($p1, $p2, $p3, $p4, $p5){
            $stmt = $this->db->prepare("INSERT INTO ost (type_ost, titre, auteur, note, anime_id) VALUES (?,?,?,?,?)");
            $stmt->bindParam(1, $p1);
            $stmt->bindParam(2, $p2);
            $stmt->bindParam(3, $p3);
            $stmt->bindParam(4, $p4);
            $stmt->bindParam(5, $p5);
            $stmt->execute();
        }

        public function insertAnime($p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10, $p11){
            $stmt = $this->db->prepare("INSERT INTO anime (nom, nb_ep, nb_oav, nb_film, note, synopsis, Auteur, Studio, img, imglarge, watching) 
                                        VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bindParam(1, $p1);
            $stmt->bindParam(2, $p2);
            $stmt->bindParam(3, $p3);
            $stmt->bindParam(4, $p4);
            $stmt->bindParam(5, $p5);
            $stmt->bindParam(6, $p6);
            $stmt->bindParam(7, $p7);
            $stmt->bindParam(8, $p8);
            $stmt->bindParam(9, $p9);
            $stmt->bindParam(10, $p10);
            $stmt->bindParam(11, $p11);
            $stmt->execute();
        }

        public function insertAnimeSeason($p1){
            $stmt = $this->db->prepare("INSERT INTO anime_season (anime_id) VALUES (?)");
            $stmt->bindParam(1, $p1);
            $stmt->execute();
        }

        public function insertOSTByCSV($p1, $p2, $p3, $p4, $p5){
            $stmt = $this->db->prepare("INSERT IGNORE INTO ost (type_ost, titre, auteur, note, anime_id) VALUES (?,?,?,?,?)");
            $stmt->bindParam(1, $p1);
            $stmt->bindParam(2, $p2);
            $stmt->bindParam(3, $p3);
            $stmt->bindParam(4, $p4);
            $stmt->bindParam(5, $p5);
            $stmt->execute();
        }

        public function prepareRequest($request){
            $stmt = $this->db->prepare($request);
            return $stmt;
        }

        public function insertAnimeByCSV($stmt, $p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10){
            $stmt->bindParam(1, $p1);
            $stmt->bindParam(2, $p2);
            $stmt->bindParam(3, $p3);
            $stmt->bindParam(4, $p4);
            $stmt->bindParam(5, $p5);
            $stmt->bindParam(6, $p6);
            $stmt->bindParam(7, $p7);
            $stmt->bindParam(8, $p8);
            $stmt->bindParam(9, $p9);
            $stmt->bindParam(10, $p10);
            $stmt->execute();
        }

        public function insertAnimeGenreByCSV($p1, $p2){
            $stmt = $this->db->prepare("INSERT INTO anime_genre (anime_id, genre_id) VALUES (?,?)");
            $stmt->bindParam(1, $p1);
            $stmt->bindParam(2, $p2);
            $stmt->execute();
        }

        public function updateAnime($p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10){
            $stmt = $this->db->prepare("UPDATE anime SET nom=?, nb_ep=?, nb_oav=?, nb_film=?, note=?, synopsis=?, Auteur=?,
                                        Studio=?, watching=? WHERE id=?");
            $stmt->bindParam(1, $p1);
            $stmt->bindParam(2, $p2);
            $stmt->bindParam(3, $p3);
            $stmt->bindParam(4, $p4);
            $stmt->bindParam(5, $p5);
            $stmt->bindParam(6, $p6);
            $stmt->bindParam(7, $p7);
            $stmt->bindParam(8, $p8);
            $stmt->bindParam(9, $p9);
            $stmt->bindParam(10, $p10);
            $stmt->execute();
        }

        public function updateOST($p1, $p2, $p3, $p4, $p5, $p6){
            $stmt = $this->db->prepare("UPDATE ost SET type_ost=?, titre=?, auteur=?, note=?, anime_id=? WHERE id=?");
            $stmt->bindParam(1, $p1);
            $stmt->bindParam(2, $p2);
            $stmt->bindParam(3, $p3);
            $stmt->bindParam(4, $p4);
            $stmt->bindParam(5, $p5);
            $stmt->bindParam(6, $p6);
            $stmt->execute();
        }

        public function selectGenreID($p1){
            $stmt = $this->db->prepare("SELECT id FROM genre WHERE nom=?");
            $stmt->bindParam(1, $p1);
            $stmt->execute();
        }

        // Selectionner une requête
        public function selectRequest($request){
            return $this->db->query($request);
        }
    }
?>