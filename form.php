<!DOCTYPE html>
<html lang="NL-nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Gastenboek</title>
</head>
<body class="form-body">

    <nav>
        <ul>
            <img class="logo" src="./assets/logo.png">
            <a href="index.php"><li>Home</li></a>
            <a href="gastenboek.php"><li>Gastenboek</li></a>
            <a class="active" href="form.php"><li>Schrijven</li></a>
        </ul>
    </nav>

    <h1 class="form-title">Bericht Scrijven</h1>

    <form method="post" class="form">
        <label for="naam">Naam:</label>
        <input type="text" name="naam" placeholder="Naam :">
        <br>
        <label for="email">Email: </label>
        <input type="email" name="email" placeholder="Email :">
        <br>
        <label for="bericht">Bericht: </label>
        <textarea name="bericht" cols="28" rows="8" placeholder="Bericht :"></textarea>
        <br>
        <button type="submit" name="toevoegen">Toevoegen</button>
    </form>

    <?php

        include "function.php";
        postInfo();
        makeDB();

    ?>
    
</body>
</html>