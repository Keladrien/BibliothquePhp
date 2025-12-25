<?php

session_start();

include_once "include/config.php";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_errno) {
    echo "Échec de la connexion à la base de données MySQL : " . $mysqli->connect_error;
    exit();
}


$livre = $mysqli->real_escape_string($_POST["livre"]);
$bibli = $mysqli->real_escape_string($_POST["bibli"]);
$dateEmprunt = $mysqli->real_escape_string($_POST["dateEmprunt"]);
$userId = $_SESSION["userId"];

$reservationEnCourSQL = $mysqli->query("SELECT `emp_livres_id_1`, `emp_livres_id_2`FROM `emprunteur` WHERE `id` = $userId");
$reservationEnCour = $reservationEnCourSQL->fetch_assoc();

$livreIdSQL = $mysqli->query("SELECT `id` FROM `livres` WHERE `titre` = '$livre'");
$livreId = $livreIdSQL->fetch_assoc();
$livreSelect = $livreId["id"];


$dateEmpruntChoisie = new DateTime($dateEmprunt);
$retourPrevuNonformat = $dateEmpruntChoisie->modify('+2 weeks');
$retourPrevu = $retourPrevuNonformat->format('Y-m-d H:i:s');


if ($reservationEnCour["emp_livres_id_1"] === NULL && $reservationEnCour["emp_livres_id_2"] === NULL || $reservationEnCour["emp_livres_id_1"] === NULL && $reservationEnCour["emp_livres_id_2"] !== NULL) {
    if (($req = $mysqli->prepare("INSERT INTO `livres_emprunte`(`date_emprunt`, `date_retour_max`,`emprunteur_id`, `livres_id`) VALUES (?,?,?,?)")) && ($req2 = $mysqli->prepare("UPDATE `emprunteur` SET `emp_livres_id_1`= LAST_INSERT_ID() WHERE `id` = ?"))) {

        $req->bind_param("ssss", $dateEmprunt, $retourPrevu, $userId, $livreSelect);
        $req2->bind_param("s", $userId);

        $req->execute();
        $req2->execute();

        $req->close();
        $req2->close();
        $mysqli->close();

        header('Location: ClientdisponibleEmprunt.php');


    } else {
        echo "Erreur de request";
    }
} else if ($reservationEnCour["emp_livres_id_1"] !== NULL && $reservationEnCour["emp_livres_id_2"] === NULL) {
    if (($req = $mysqli->prepare("INSERT INTO `livres_emprunte`(`date_emprunt`, `date_retour_max`,`emprunteur_id`, `livres_id`) VALUES (?,?,?,?)")) && ($req2 = $mysqli->prepare("UPDATE `emprunteur` SET `emp_livres_id_2`= LAST_INSERT_ID() WHERE `id` = ?"))) {

        $req->bind_param("ssss", $dateEmprunt, $retourPrevu, $userId, $livreSelect);
        $req2->bind_param("s", $userId);

        $req->execute();
        $req2->execute();

        $req->close();
        $req2->close();
        $mysqli->close();

        header('Location: ClientdisponibleEmprunt.php');
    } else {
        echo "Erreur de request";
    }
}




?>