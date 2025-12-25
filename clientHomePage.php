<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client</title>
    <link rel="stylesheet" href="style/css/style.css">
</head>

<body>
    <?php

    session_start();

    include_once "include/config.php";

    $mysqli = new mysqli($host, $username, $password, $database);

    if ($mysqli->connect_errno) {
        echo "Échec de la connexion à la base de données MySQL : " . $mysqli->connect_error;
        exit();
    }

    if (isset($_SESSION["user"])) {
        echo "<h2> Bonjour " . $_SESSION["user"] . "</h2>";
    }

    ?>
    <nav>
        <a href="ClientdisponibleEmprunt.php">Livre disponible</a>

        <a href="clientEmpruntEnCours.php">Mes emprunts en cours</a>

    </nav>

    <a class="logOffBtn" href="LogOut.php">Deconnexion</a>

</body>

</html>