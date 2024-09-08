<?php
    // Affichage de toutes les erreurs
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    // Encodage
    header('Content-Type: text/html; charset=utf-8');

    // Début de la session
    session_start();

    // --- VARIABLES DU FORMULAIRE --- //

    // Variable du nouveau compte
    $username = $_POST["username"];
    $mail = $_POST["mail"];
    $mdp = $_POST["mdp"];
    $répé_mdp = $_POST["répé_mdp"];

    // --- ERREURS NOM --- //

    // Si le nom n'existe pas
    if(empty($username))
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : vous n'avez pas de nom.</p>";

        // Fin du script
        exit;
    }

    // Si le nom est trop long
    if(strlen($username) > 20)
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : votre nom fait plus de 20 caractères.</p>";

        // Fin du script
        exit;
    }

    // --- ERREURS MAIL --- //

    // Si le mail n'existe pas
    if(empty($mail))
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : vous n'avez pas de mail.</p>";

        // Fin du script
        exit;
    }

    // Si le mail est trop long
    if(strlen($mail) > 80)
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : votre mail fait plus de 80 caractères.</p>";

        // Fin du script
        exit;
    }

    // --- ERREURS MOT DE PASSE --- //

    // Si le mot de passe n'existe pas
    if(empty($mdp))
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : vous n'avez pas de mot de passe.</p>";

        // Fin du script
        exit;
    }

    // Si le mdp est trop court
    if(strlen($mdp) < 12)
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : votre mot de passe fait moins de 12 caractères.</p>";

        // Fin du script
        exit;
    }

    // Si le mdp est trop long
    if(strlen($mdp) > 100)
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : votre mot de passe fait plus de 100 caractères.</p>";

        // Fin du script
        exit;
    }

    // --- ERREURS MOT DE PASSE RÉPÉTÉ --- //

    // Si le mot de passe répété n'existe pas
    if(empty($répé_mdp))
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : vous n'avez pas de mot de passe répété.</p>";

        // Fin du script
        exit;
    }

    // Si le mdp répété est trop court
    if(strlen($répé_mdp) < 12)
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : votre mot de passe répété fait moins de 12 caractères.</p>";

        // Fin du script
        exit;
    }

    // Si le mdp répété est trop long
    if(strlen($répé_mdp) > 100)
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : votre mot de passe répété fait plus de 100 caractères.</p>";

        // Fin du script
        exit;
    }

    // Si les mots de passe sont différents
    if($mdp !== $répé_mdp)
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : vos mots de passe sont différents.</p>";

        // Fin du script
        exit;
    }

    // Si toutes les conditions sont remplis
    if(!empty($username) && strlen($username) < 21 && !empty($mail) && strlen($mail) < 81 && !empty($mdp) && strlen($mdp) > 11 && strlen($mdp) < 101 && !empty($répé_mdp) && strlen($répé_mdp) > 11 && strlen($répé_mdp) < 101 && $mdp === $répé_mdp)
    {
        // On essai d'enregistrer un nouveau compte
        try
        {
            // Connexion à la DB
            include_once("connexion_db.php");

            // Début de la transaction
            pg_query($db, "BEGIN");

            // Cryptage du mot de passe
            $mdp_crypt = password_hash($mdp, PASSWORD_BCRYPT);

            // Requête d'insertion du compte dans la DB
            $insertion_compte = "INSERT INTO utilisateurs (username, mail, crypt_pwd) VALUES ($1, $2, $3)";

            // Préparation
            $prepa_insertion_compte = pg_prepare($db, "insertion_compte", $insertion_compte);

            // Exécution
            $exec_insertion_compte = pg_execute($db, "insertion_compte", array($username, $mail, $mdp_crypt));

            // Si l'insertion échoue
            if(!$exec_insertion_compte) 
            {
                // Afficher un message d'erreur
                echo "<p>Erreur pendant l'enregistrement de votre compte: " . pg_last_error($db).". Opération annulée.</p>";

                // Annulation de la transaction
                pg_query($db, "ROLLBACK");

                // Fin du script
                exit;
            }

            // Lancement de la transaction
            pg_query($db, "COMMIT");

            // Création des variables de session
            $_SESSION["username"] = $username;
            $_SESSION["mail"] = $mail;

            // Redirection vers la page de profil
            header("Location: profile.php");

            // Fin du script
            exit;
        }
     
        // Si l'enregistrement d'un nouveau compte échoue
        catch(Throwable $exc)
        {
            // Annulation de la transaction
            pg_query($db, "ROLLBACK");

            // Affichage d'un message d'erreur à l'utilisateur
            echo "<p>Exception apparu pendant la création de votre compte : " . $exc . ". Opération annulée.</p>";

            // Fin du script
            exit;
        }
    }
?>