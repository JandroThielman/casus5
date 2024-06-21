<?php

    function parseBBCode($text) {
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        $text = preg_replace('/\[b\](.*?)\[\/b\]/', '<b>$1</b>', $text);
        $text = preg_replace('/\[u\](.*?)\[\/u\]/', '<u>$1</u>', $text);
        $text = preg_replace('/\[color=([a-zA-Z]+)\](.*?)\[\/color\]/', '<span style="color:$1">$2</span>', $text);
        $text = preg_replace('/\[size=([0-9]+(px|em|rem|%)?|small|medium|large|x-large)\](.*?)\[\/size\]/', '<span style="font-size:$1">$3</span>', $text);
        $text = str_replace(':)', '😀', $text);
        $text = str_replace(':(', '😟', $text);

        $scheldwoorden = ['Klootzak', 'klootzak', 'Eikel', 'eikel', 'Lul', 'lul', 'Hufter', 'hufter', 'Kut', 'kut', 'Sukkel', 'sukkel', 'Loser', 'loser', 'Idioot', 'idioot', 'Mongool', 'mongool', 'Fuck', 'fuck', 'Shit', 'shit', 'Asshole', 'asshole', 'Bitch', 'bitch', 'Bastard', 'bastard', 'Cunt', 'cunt', 'Prick', 'prick', 'Dick', 'dick', 'Wanker', 'wanker'];
        $replacement = '*******';
        $text = str_ireplace($scheldwoorden, $replacement, $text);
        
        return $text;
    }

    function getInfo(){
        include "connect.php";

        $query = $database->prepare("SELECT * FROM gastenboek ORDER BY `datum_tijd` DESC");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        echo "<div class='message-box'>";
            echo "<video autoplay muted loop class='vid'>";
                        echo "<source class='vid' src='./assets/vid.mp4' type='video/mp4'>";
            echo "</video>";
            echo "<h1 class='message-title'>Gastenboek</h1>";

        foreach ($result as $message) {
            echo "<h2 class='info1'>" . $message['naam'] . "</h2>";
            echo "<p class='info'>Bericht: " . parseBBCode($message['bericht']) . "</p>";
            echo "<p class='info'>Datum: " . $message['datum_tijd'] . "</p>";
            echo "<br><br>";
        }

        echo "</div>";
    }

    function postInfo(){
        include "connect.php";

        if (isset($_POST['toevoegen'])) {

                $naam = htmlspecialchars($_POST['naam']);
                $email = htmlspecialchars($_POST['email']);
                $bericht = htmlspecialchars($_POST['bericht']);
                $datum = date('Y-m-d H:i:s');

                $query = $database->prepare("INSERT INTO gastenboek(id, naam, `email`, bericht, `datum_tijd`) VALUES (NULL, :naam, :email, :bericht, :datum)");
                $query->bindParam(":naam", $naam);
                $query->bindParam(":email", $email);
                $query->bindParam(":bericht", $bericht);
                $query->bindParam(":datum", $datum);
                $query->execute();

        }

    }

    function makeDB(){
        try {

            $host = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'casus5';
            $tablename = 'gastenboek';
    
            $database = new PDO("mysql:host=$host", $username, $password);
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $stmt = $database->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?");
            $stmt->execute([$dbname]);
    
            if ($stmt->rowCount() == 0) {
                $sql = "CREATE DATABASE $dbname";
                $database->exec($sql);
                //echo "Database $dbname created successfully.<br>";
            } else {
                //echo "Database $dbname already exists.<br>";
            }
    
            $database = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $stmt = $database->prepare("SHOW TABLES LIKE ?");
            $stmt->execute([$tablename]);
    
            if ($stmt->rowCount() == 0) {
                $sql = "CREATE TABLE $tablename (
                    id INT(11) AUTO_INCREMENT PRIMARY KEY,
                    naam VARCHAR(255) NOT NULL,
                    email TEXT,
                    bericht TEXT,
                    datum_tijd DATETIME DEFAULT CURRENT_TIMESTAMP
                )";
                $database->exec($sql);
                //echo "Table $tablename created successfully.<br>";
            } else {
                //echo "Table $tablename already exists.<br>";
            }
    
        } catch (PDOException $e) {
            die("Error!: " . $e->getMessage());
        }
    }

?>