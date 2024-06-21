<?php

    try {
        $database = new PDO("mysql:host=localhost;dbname=casus5", "root", "");
    } catch (PDOException $e) {
        die("Error!: " . $e->getMessage());
    }

?>