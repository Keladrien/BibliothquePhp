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
        <a href="#addBook">Ajouter a l'inventaire</a>
        <a href="employesHomePage.php">Retour au menu principal</a>
    </nav>

    <?php


    $sql = "SELECT livres.id, `titre`, `auteur`, `date_publication`, `nombre_pages`, `Nom` FROM `livres` INNER JOIN `bibliotheque` ON livres.bibli_id = bibliotheque.id ORDER BY `Nom` ASC";

    $result = $mysqli->query($sql);

    $sql2 = "SELECT `id`, `Nom` FROM `bibliotheque`";

    $result2 = $mysqli->query($sql2);


    echo '<h3>Liste d`inventaire</h3>';


    echo '<table><tr><th>Titre</th><th>Auteur</th><th>Date de publication</th><th>Nombre de pages</th><th>Bibliothèque</th><th></th></tr>';


    while ($row = $result->fetch_assoc()) {

        echo "<tr>";
        echo "<td>" . $row["titre"] . "</td>";
        echo "<td>" . $row["auteur"] . "</td>";
        echo "<td>" . $row["date_publication"] . "</td>";
        echo "<td>" . $row["nombre_pages"] . "</td>";
        echo "<td>" . $row["Nom"] . "</td>";
        echo '<td><form action="supprimeInventaire.php" method="POST">
    <input type="number" value=' . $row["id"] . ' hidden name="id" id="id">
    <input type="submit" value="Supprimer">
</form></td>';
        echo "</tr>";
    }
    echo "</table>";

    ?>



    <fieldset>
        <legend>
            <h3 id="addBook">Ajouter un livre a l'inventaire</h3>
        </legend>
        <form action="ajoutInvnetaire.php" method="POST">
            <div>
                <label for="titre">Titre :</label>
                <input type="text" name="titre" id="titre" placeholder="Titre" required>
            </div>

            <div>
                <label for="autheur">Auteur :</label>
                <input type="text" name="autheur" id="autheur" placeholder="Autheur" required>
            </div>

            <div>
                <label for="publiDate">Date de publication :</label>
                <input type="date" name="publiDate" id="publiDate" placeholder="Date de publication" required>
            </div>

            <div>
                <label for="pages">Nombre de pages :</label>
                <input type="number" name="pages" id="pages" placeholder="Nombre de pages" required>
            </div>
            <div>
                <label for="bibli">Bibliothèque :</label>
                <select name="bibli" id="bibli" required>
                    <option value="Selectioné une bibliotheque" disabled selected>Selectioné une bibliotheque</option>
                    <?php
                    while ($row2 = $result2->fetch_assoc()) {
                        echo "<option value=" . $row2["id"] . ">" . $row2["Nom"] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <input type="submit" value="Soumettre">

        </form>
    </fieldset>





    <a class="retourBtn" href="employesHomePage.php">Retour au menu principal</a>

</body>

</html>