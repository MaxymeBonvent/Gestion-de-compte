<?php
    // Affichage de toutes les erreurs
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    // Encodage
    header('Content-Type: text/html; charset=utf-8');

    // Début de la session
    session_start();

    // Couleur du texte
    $couleur_txt = "rgb(180, 180, 180)";

    // DÉBUT DE PAGE
    echo "<body style='background-color: black;'>";

    // --- VARIABLES DU FORMULAIRE --- //

    // Variables du compte à supprimer
    $username = trim($_POST["username"]);
    echo $username;

    // FIN DE PAGE
    echo "</body>";
?>