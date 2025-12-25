<?php

session_start();

include_once "include/config.php";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_errno) {
    echo "Échec de la connexion à la base de données MySQL : " . $mysqli->connect_error;
    exit();
}


$titre = $mysqli->real_escape_string($_POST["titre"]);
$autheur = $mysqli->real_escape_string($_POST["autheur"]);
$publiDate = $mysqli->real_escape_string($_POST["publiDate"]);
$pages = $mysqli->real_escape_string($_POST["pages"]);
$bibli = $mysqli->real_escape_string($_POST["bibli"]);


if ($req = $mysqli->prepare("INSERT INTO `livres`( `titre`, `auteur`, `date_publication`, `nombre_pages`, `bibli_id`) VALUES (?,?,?,?,?)")) {

    $req->bind_param("sssss", $titre, $autheur, $publiDate, $pages, $bibli);

    $req->execute();
    header('Location: employesInventaire.php');

    $req->close();
    $mysqli->close();

} else {
    echo "Erreur de request";
}

?>