<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
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

    if (isset($_SESSION["error"])) {
        echo ($_SESSION["error"]);
        unset($_SESSION["error"]);
    }

    if (isset($_SESSION["creationOk"])) {
        echo ($_SESSION["creationOk"]);
        unset($_SESSION["creationOk"]);
    }

    $sql = "SELECT `id`, `Nom` FROM `bibliotheque` WHERE 1";

    $result = $mysqli->query($sql);

    ?>

    <h2>Création de compte</h2>

    <nav>
        <a href="employesHomePage.php">Retour au menu principal</a>
    </nav>




    <div class="connexionField">
        <fieldset>
            <legend>Création de compte client</legend>
            <form action="creationCompteClient.php" method="POST">

                <div>
                    <label for="user">Utilisateur : </label>
                    <input id="user" name="user" type="text" placeholder="Utilisateur">
                </div>
                <div>
                    <label for="mdp">Mot de passe : </label>
                    <input id="mdp" name="mdp" type="password" placeholder="Mot de passe">
                </div>
                <div>
                    <label for="nom">Nom complet : </label>
                    <input id="nom" name="nom" type="text" placeholder="Nom complet">
                </div>
                <div>
                    <label for="email">Courielle : </label>
                    <input id="email" name="email" type="text" placeholder="Courielle">
                </div>

                <div>
                    <label for="porte">Numéro de porte : </label>
                    <input id="porte" name="porte" type="number" placeholder="Numéro de porte">
                </div>
                <div>
                    <label for="rue">Rue : </label>
                    <input id="rue" name="rue" type="text" placeholder="Rue">
                </div>
                <div>
                    <label for="ville">Ville : </label>
                    <input id="ville" name="ville" type="text" placeholder="Ville">
                </div>
                <div>
                    <label for="zipCode">Code Postal : </label>
                    <input id="zipCode" name="zipCode" type="text" placeholder="Code Postal">
                </div>
                <div>
                    <label for="province">Province : </label>
                    <input id="province" name="province" type="text" placeholder="Province">
                </div>
                <div>
                    <label for="pays">Pays : </label>
                    <input id="pays" name="pays" type="text" placeholder="Pays">
                </div>
                <input type="submit" value="Créer le compte">
            </form>
        </fieldset>

        <?php

        if ($_SESSION["user"] === "Monique01") {
            echo '
        <fieldset>
            <legend>Création de compte employer</legend>
            <form action="creationCompteEmploye.php" method="POST">

                <div>
                    <label for="user">Utilisateur : </label>
                    <input id="user" name="user" type="text" placeholder="Utilisateur">
                </div>
                <div>
                    <label for="mdp">Mot de passe : </label>
                    <input id="mdp" name="mdp" type="password" placeholder="Mot de passe">
                </div>
                <div>
                    <label for="nom">Nom complet : </label>
                    <input id="nom" name="nom" type="text" placeholder="Nom complet">
                </div>
                <div>
                    <label for="nom">Salaire : </label>
                    <input id="salaire" name="salaire" type="number" placeholder="Salaire">
                </div>
                <div>
                    <label for="nom">Date d`embauche : </label>
                    <input id="date_embauche" name="date_embauche" type="date" placeholder="Date d`embauche">
                </div>
                <div>
                    <label for="bibli">Bibliothèque :</label>
                    <select name="bibli" id="bibli">
                    <option value="Selectioné une bibliotheque" disabled selected>Selectioné une bibliotheque</option>';
            while ($row = $result->fetch_assoc()) {
                echo '<option value=' . $row["id"] . '>';
                echo $row["Nom"];
                echo '</option>';
            }
            echo '</select>
                </div>
                <div>
                    <label for="porte">Numéro de porte : </label>
                    <input id="porte" name="porte" type="number" placeholder="Numéro de porte">
                </div>
                <div>
                    <label for="rue">Rue : </label>
                    <input id="rue" name="rue" type="text" placeholder="Rue">
                </div>
                <div>
                    <label for="ville">Ville : </label>
                    <input id="ville" name="ville" type="text" placeholder="Ville">
                </div>
                <div>
                    <label for="zipCode">Code Postal : </label>
                    <input id="zipCode" name="zipCode" type="text" placeholder="Code Postal">
                </div>
                <div>
                    <label for="province">Province : </label>
                    <input id="province" name="province" type="text" placeholder="Province">
                </div>
                <div>
                    <label for="pays">Pays : </label>
                    <input id="pays" name="pays" type="text" placeholder="Pays">
                </div>
                <input type="submit" value="Créer le compte">
            </form>
        </fieldset>';
        }
        ?>
    </div>

</body>

</html>