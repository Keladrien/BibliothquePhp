<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande d'emprunt</title>
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
        echo "<h2> Bonjour " . $_SESSION["user"] . ", voici les emprunts en attente confirmation</h2>";
    }

    ?>
    <nav>
        <a href="employesHomePage.php">Retour au menu principal</a>
    </nav>

    <?php


    $sql = "SELECT `titre`, `Nom`, `date_emprunt`, `date_retour_max` ,`emp_nom`, `email`, livres_emprunte.id AS `livres_emprunte_id` , emprunteur.id AS `emprunteur_id`
FROM `livres_emprunte` 
INNER JOIN `livres`
ON livres_emprunte.livres_id = livres.id
INNER JOIN `bibliotheque` 
ON livres.bibli_id = bibliotheque.id 
INNER JOIN `emprunteur`
ON livres_emprunte.id = emprunteur.emp_livres_id_1 
OR livres_emprunte.id = emprunteur.emp_livres_id_2 
WHERE `demande_emprunt` IS NULL
ORDER BY `date_retour_max` ASC, `Nom` ASC;";

    $result = $mysqli->query($sql);


    echo '<h3>Emprunt en attente de confirmation</h3>';


    echo '<table><tr><th>Titre</th><th>Date de l`emprunt</th><th>Date de retour prévu</th><th>Nom de l`emprunteur</th><th>Courielle</th><th>Bibliothèque</th><th></th></tr>';


    while ($row = $result->fetch_assoc()) {

        echo "<tr>";
        echo "<td>" . $row["titre"] . "</td>";
        echo "<td>" . $row["date_emprunt"] . "</td>";
        echo "<td>" . $row["date_retour_max"] . "</td>";
        echo "<td>" . $row["emp_nom"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["Nom"] . "</td>";
        echo '<td>
<form action="accepterOuRefuserEmprunt.php" method="POST">
    <input type="number" value="1" hidden name="accepte" id="accepte">
    <input type="number" value=' . $row["emprunteur_id"] . ' hidden name="empId" id="empId">
    <input type="number" value=' . $row["livres_emprunte_id"] . ' hidden name="livres_emprunte_id" id="livres_emprunte_id">
    <input type="submit" value="Accepter">
</form>
<form action="accepterOuRefuserEmprunt.php" method="POST">
    <input type="number" value="0" hidden name="accepte" id="accepte">
    <input type="number" value=' . $row["emprunteur_id"] . ' hidden name="empId" id="empId">
    <input type="number" value=' . $row["livres_emprunte_id"] . ' hidden name="livres_emprunte_id" id="livres_emprunte_id">
    <input type="submit" value="Refuser">
</form></td>';

        echo "</tr>";
    }
    echo "</table>";

    ?>


</body>

</html>