<?php
    // Affichage de toutes les erreurs
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    // Encodage
    header('Content-Type: text/html; charset=utf-8');

    // Connexion à la DB
    include_once("connexion_db.php");

    // DÉBUT DE PAGE
    echo "<!DOCTYPE html><html lang='fr'><body style='background-color: black;'>";

    // Début d'affichage
    echo "<pre style='color : rgb(180, 180, 180); text-align: center; font-size: 20px;'>";

        // --- ERREURS FORMULAIRE --- //

        // Si la méthode n'est pas POST
        if($_SERVER["REQUEST_METHOD"] !== "POST")
        {
            // Afficher un message d'erreur
            echo "Erreur : la méthode utilisé n'est pas POST";

            // Fin du script
            exit;
        }

        // Variables du compte qui demande un nouveau mdp
        $username = $_POST["username"];
        $email = $_POST["email"];

        // --- ERREURS NOM  --- //

        // S'il n'y a pas de nom
        if(empty($username))
        {
            // Afficher un message d'erreur
            echo "Erreur : aucun nom.";

            // Fin du script
            exit;
        }

        // Si le nom est trop long
        if(strlen($username) > 20)
        {
            // Afficher un message d'erreur
            echo "Erreur : le nom $username > 20 caractères";

            // Fin du script
            exit;
        }

        // --- ERREURS MAIL  --- //

        // S'il n'y a pas de mail
        if(empty($email))
        {
            // Afficher un message d'erreur
            echo "Erreur : aucun mail.";

            // Fin du script
            exit;
        }

        // Si le mail est trop long
        if(strlen($email) > 100)
        {
            // Afficher un message d'erreur
            echo "Erreur : le mail $email > 100 caractères";

            // Fin du script
            exit;
        }

        // --- FORMULAIRE VALIDE --- //
        else
        {
            echo "Formulaire valide.";
            exit;
        }
        


    // Fin d'affichage
    echo "</pre>";

    // FIN DE PAGE
    echo "</html></body>";
?>