<?php

session_start();

include_once "include/config.php";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_errno) {
    echo "Échec de la connexion à la base de données MySQL : " . $mysqli->connect_error;
    exit();
}


$id = $mysqli->real_escape_string($_POST["id"]);


if (($req = $mysqli->prepare("DELETE FROM `livres_emprunte` WHERE livres_emprunte.id = ?")) && ($req2 = $mysqli->prepare("UPDATE emprunteur INNER JOIN livres_emprunte ON emprunteur.id = livres_emprunte.emprunteur_id SET emp_livres_id_1 = IF(emp_livres_id_1 = ?, NULL, emp_livres_id_1), emp_livres_id_2 = IF(emp_livres_id_2 = ?, NULL, emp_livres_id_2) WHERE livres_emprunte.id = ?;"))) {

    $req->bind_param("s", $id);
    $req2->bind_param("sss", $id, $id, $id);

    $req->execute();
    $req2->execute();

    $req->close();
    $mysqli->close();

    header('Location: employesEmpruntEnCours.php');



} else {
    echo "Erreur de request";
}

?>