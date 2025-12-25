<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunts en cours</title>
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
        echo "<h2> Bonjour " . $_SESSION["user"] . ", voici vos livres empruntés</h2>";
    }

    $req = $mysqli->query("SELECT  `demande_emprunt`, `date_emprunt`, `date_retour_max`, `titre` FROM `livres_emprunte` INNER JOIN `livres` ON `livres_id` = livres.id WHERE `emprunteur_id` = 32");
    $result = $req

        ?>
    <nav>
        <a href="clientHomePage.php">Retour au menu principal</a>
    </nav>

    <?php
    echo '<table><tr><th>Titre</th><th>Demande</th><th>Date d`emprunt</th><th>Date de retour</th></tr>';


    while ($row = $result->fetch_assoc()) {

        echo "<tr>";
        echo "<td>" . $row["titre"] . "</td>";

        if ($row["demande_emprunt"] == 1) {
            echo "<td>Accepté</td>";
        } else {
            echo "<td>En traitement</td>";
        }
        echo "<td>" . $row["date_emprunt"] . "</td>";
        echo "<td>" . $row["date_retour_max"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    ?>

</body>

</html>