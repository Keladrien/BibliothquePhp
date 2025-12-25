<?php

session_start();

include_once "include/config.php";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_errno) {
    echo "Échec de la connexion à la base de données MySQL : " . $mysqli->connect_error;
    exit();
}


$id = $mysqli->real_escape_string($_POST["id"]);


if ($req = $mysqli->prepare("DELETE FROM `livres` WHERE id=?")) {

    $req->bind_param("s", $id);

    $req->execute();
    header('Location: employesInventaire.php');

    $req->close();
    $mysqli->close();

} else {
    echo "Erreur de request";
}

?>