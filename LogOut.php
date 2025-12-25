<?php

session_start();

include_once "include/config.php";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_errno) {
    echo "Échec de la connexion à la base de données MySQL : " . $mysqli->connect_error;
    exit();
} 

unset($_SESSION["user"]);
header('Location: index.php');


?>