<?php

session_start();

include_once "include/config.php";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_errno) {
    echo "Échec de la connexion à la base de données MySQL : " . $mysqli->connect_error;
    exit();
}


$accepte = $mysqli->real_escape_string($_POST["accepte"]);
$empId = $mysqli->real_escape_string($_POST["empId"]);
$livres_emprunte_id = $mysqli->real_escape_string($_POST["livres_emprunte_id"]);


if ($accepte === "1") {
    if ($req = $mysqli->prepare("UPDATE `livres_emprunte` SET `demande_emprunt`= ? WHERE `id` = ?")) {

        $req->bind_param("ss", $accepte, $livres_emprunte_id);

        $req->execute();


        header('Location: employesDemandeEmprunt.php');

        $req->close();
        $mysqli->close();


    } else {
        echo "Erreur de request";
    }

} elseif ($accepte === "0") {
    if (($req = $mysqli->prepare("UPDATE `emprunteur` SET `emp_livres_id_1` = CASE WHEN `emp_livres_id_1` = ? THEN NULL ELSE `emp_livres_id_1` END, `emp_livres_id_2` = CASE WHEN `emp_livres_id_2` = ? THEN NULL ELSE `emp_livres_id_2` END WHERE id = ?;")) && ($req2 = $mysqli->prepare("DELETE FROM `livres_emprunte` WHERE id = ?"))) {

        $req->bind_param("sss", $livres_emprunte_id, $livres_emprunte_id, $empId);
        $req2->bind_param("s", $livres_emprunte_id);

        $req->execute();
        $req2->execute();


        header('Location: employesDemandeEmprunt.php');

        $req->close();
        $req2->close();
        $mysqli->close();


    } else {
        echo "Erreur de request";
    }
}

?>