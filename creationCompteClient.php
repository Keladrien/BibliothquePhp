<?php

session_start();

include_once "include/config.php";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_errno) {
    echo "Échec de la connexion à la base de données MySQL : " . $mysqli->connect_error;
    exit();
}


$nom = $mysqli->real_escape_string($_POST["nom"]);
$email = $mysqli->real_escape_string($_POST["email"]);
$user = $mysqli->real_escape_string($_POST["user"]);
$mdp = $mysqli->real_escape_string($_POST["mdp"]);
$porte = $mysqli->real_escape_string($_POST["porte"]);
$rue = $mysqli->real_escape_string($_POST["rue"]);
$ville = $mysqli->real_escape_string($_POST["ville"]);
$zipCode = $mysqli->real_escape_string($_POST["zipCode"]);
$province = $mysqli->real_escape_string($_POST["province"]);
$pays = $mysqli->real_escape_string($_POST["pays"]);
$mdp_hashed = password_hash($mdp, PASSWORD_DEFAULT);



if (($req = $mysqli->prepare("INSERT INTO `adresse` ( `numero_porte`, `rue`, `ville`, `code_postal`, `province`, `pays`) VALUES (? ,? ,? ,? ,? ,?) ON DUPLICATE KEY UPDATE `id`  = LAST_INSERT_ID(`id`)")) && ($req2 = $mysqli->prepare("INSERT INTO `emprunteur`(`emp_nom`, `email`, `adresse_id`, `emp_user`, `emp_mdp`) VALUES ( ? , ?, LAST_INSERT_ID(), ?, ?)"))) {

    $req->bind_param("ssssss", $porte, $rue, $ville, $zipCode, $province, $pays);
    $req2->bind_param("ssss", $nom, $email, $user, $mdp_hashed);

    $req->execute();


    try {
        $req2->execute();
    } catch (mysqli_sql_exception) {
        $_SESSION['error'] = '<script>alert("Utilisateur déjà utilisé!");</script>';
        $sql = "DELETE FROM `adresse` ORDER BY id DESC LIMIT 1";
        $delete = $mysqli->query($sql);
        $req->close();
        $mysqli->close();
        header('Location: employesNouveauCompte.php');


    }
    $_SESSION['creationOk'] = '<script>alert("Utilisateur créé avec succès!");</script>';

    $req->close();
    $mysqli->close();

    header('Location: employesNouveauCompte.php');



} else {
    echo "Erreur de request";
}

?>