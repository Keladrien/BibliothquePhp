<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style/css/style.css">
</head>

<body>

    <?php

    session_start();

    if (isset($_SESSION["error"])) {
        echo ($_SESSION["error"]);
        unset($_SESSION["error"]);
    }


    ?>

    <h1>Bienvenue à la bibliotheque</h1>
    <h2>Que voulez vous faire aujourdui</h2>

    <div class="connexionField">
        <fieldset>
            <legend>Connextion Emprunteur</legend>
            <form action="clientConnexion.php" method="POST">
                <div>
                    <label for="user">Utilisateur : </label>
                    <input id="user" name="user" type="text" placeholder="Utilisateur">
                </div>
                <div>
                    <label for="mdp">Mot de passe : </label>
                    <input id="mdp" name="mdp" type="password" placeholder="Mot de passe">
                </div>
                <input class="connexion" type="submit" value="Connexion">
            </form>
        </fieldset>



        <fieldset>
            <legend>Connexion Employes</legend>
            <form action="employesConnexion.php" method="POST">
                <div>
                    <label for="user">Utilisateur : </label>
                    <input id="user" name="user" type="text" placeholder="Utilisateur">
                </div>
                <div>
                    <label for="mdp">Mot de passe : </label>
                    <input id="mdp" name="mdp" type="password" placeholder="Mot de passe">
                </div>
                <input class="connexion" type="submit" value="Connexion">
            </form>
        </fieldset>

    </div>

</body>

</html>