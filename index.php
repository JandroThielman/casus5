<!DOCTYPE html>
<html lang="NL-nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Gastenboek</title>
</head>
<body>

    <div class="home-page">

        <nav>
            <ul>
                <img class="logo" src="./assets/logo.png">
                <a class="active" href="index.php"><li>Home</li></a>
                <a href="gastenboek.php"><li>Gastenboek</li></a>
                <a href="form.php"><li>Schrijven</li></a>
            </ul>
        </nav>

        <h1 class="title">Gastenboek</h1>

    </div>

    <?php

        include "function.php";
        makeDB();

    ?>
    
</body>
</html>