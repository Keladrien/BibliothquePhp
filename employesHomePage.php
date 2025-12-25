<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employes</title>
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

  $req = $mysqli->query("SELECT COUNT(*)  FROM `livres_emprunte` WHERE demande_emprunt IS NULL");
  $countAssoc = $req->fetch_assoc();
  $count = $countAssoc["COUNT(*)"];

  ?>
  <nav>
    <a href="employesInventaire.php">Consultation d'inventaire</a>

    <a href="employesEmpruntEnCours.php">Emprunt en cours</a>

    <?php

    if ($count > 0) {
      echo '<a href="employesDemandeEmprunt.php" class="emprunt">Demande d`emprunt (' . $count . ')</a>';
    } else {
      echo '<a href="employesDemandeEmprunt.php">Demande d`emprunt</a>';
    }

    ?>



    <a href="employesNouveauCompte.php">Creation d'un nouveau compte</a>


  </nav>

  <a class="logOffBtn" href="LogOut.php">Deconnexion</a>

</body>

</html>