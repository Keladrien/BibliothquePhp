<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaire</title>
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
        echo "<h2> Bonjour " . $_SESSION["user"] . ", voici l'inventaire pour aujourd'hui</h2>";
    }

    ?>
    <nav>
        <a href="clientHomePage.php">Retour au menu principal</a>
    </nav>

    <?php


    $sql = "SELECT livres.id, `titre`, `auteur`, `date_publication`, `nombre_pages`, `Nom`, livres_id
FROM `livres` 
INNER JOIN `bibliotheque` 
ON livres.bibli_id = bibliotheque.id 
LEFT JOIN `livres_emprunte`
ON livres.id = livres_emprunte.livres_id
WHERE livres_emprunte.livres_id IS NULL
ORDER BY `Nom` ASC";


    $result = $mysqli->query($sql);


    echo '<h3>Liste d`inventaire</h3>';


    echo '<table><tr><th>Titre</th><th>Auteur</th><th>Date de publication</th><th>Nombre de pages</th><th>Bibliothèque</th><th></th></tr>';


    while ($row = $result->fetch_assoc()) {

        echo "<tr>";
        echo "<td>" . $row["titre"] . "</td>";
        echo "<td>" . $row["auteur"] . "</td>";
        echo "<td>" . $row["date_publication"] . "</td>";
        echo "<td>" . $row["nombre_pages"] . "</td>";
        echo "<td>" . $row["Nom"] . "</td>";
        echo '<td><form action="clientReservation.php" method="POST">
    <input type="number" value=' . $row["id"] . ' hidden name="id" id="id">
    <input type="submit" value="Faire une demande">
</form></td>';
        echo "</tr>";
    }
    echo "</table>";

    ?>


</body>

</html>