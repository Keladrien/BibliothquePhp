<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>
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

    $userId = $_SESSION["userId"];


    echo '<nav>
        <a href="clientHomePage.php">Retour au menu principal</a>
    </nav>';

    $reservationEnCourSQL = $mysqli->query("SELECT `emp_livres_id_1`, `emp_livres_id_2`FROM `emprunteur` WHERE `id` = $userId");
    $reservationEnCour = $reservationEnCourSQL->fetch_assoc();


    if ($reservationEnCour["emp_livres_id_1"] === NULL || $reservationEnCour["emp_livres_id_2"] === NULL) {
        $id = $mysqli->real_escape_string($_POST["id"]);

        $sql = "SELECT  livres.id, bibliotheque.id, `titre`, `Nom` FROM `livres` INNER JOIN `bibliotheque` ON livres.bibli_id = bibliotheque.id WHERE livres.id = $id";

        $result = $mysqli->query($sql);

        $selected = $result->fetch_assoc();


        echo
            '<fieldset>
        <legend>
            <h3>Réservation</h3>
        </legend>
        <form action="demandeReservation.php" method="POST">            
           
            <div>
                <label for="livre">Livre a réservé :</label>
                <input type="text" name="livre" id="livre" value="' . $selected["titre"] . '" readonly >
            </div>
            <div>
                <label for="biblio">Bibliothèque :</label>
                <input type="text" name="bibli" id="bibli" value="' . $selected["Nom"] . '" readonly >
            </div>
              <div>
                <label for="dateEmprunt">Date de l`emprunt :</label>
                <input type="date" name="dateEmprunt" id="dateEmprunt">
            </div>
            <p>Les livres doivent être raportés au maximum 2 semaines apres l`emprunt.</p>
            <input type="submit" value="Soumettre">
        </form>
    </fieldset>';
    } else {
        echo
            '
        <h3>Nombre maximum de livres déjà emprunté</h3>
        <p>Veuillez retrouner un livres avant de faire une nouvelle demande</p>
        ';
    }




    ?>
</body>

</html>