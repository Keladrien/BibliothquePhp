<?php

session_start();

include_once "include/config.php";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_errno) {
    echo "Échec de la connexion à la base de données MySQL : " . $mysqli->connect_error;
    exit();
}


$user = $mysqli->real_escape_string($_POST["user"]);
$mdp = $mysqli->real_escape_string($_POST["mdp"]);

if ($req = $mysqli->prepare("SELECT emp_mdp , id FROM emprunteur WHERE emp_user = ?")) {

    $req->bind_param("s", $user);

    if ($req->execute()) {
        $result = $req->get_result();
        $ligne = $result->fetch_assoc();

        $mdp_hashed = $ligne["emp_mdp"];

        if (password_verify($mdp, $mdp_hashed)) {
            $_SESSION["user"] = $user;
            $_SESSION["userId"] = $ligne["id"];
            header('Location: clientHomePage.php');

        } else {
            $_SESSION['error'] = '<script>alert("Mot de passe invalide!");</script>';
            header(header: 'Location: index.php');
        }


    } else {
        echo "bad bind";
    }

    $req->close();
    $mysqli->close();

} else {
    echo "Erreur de request";
}

?>