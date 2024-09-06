<?php
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

    // Si les mots de passe sont différents
    if($mdp !== $répé_mdp)
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : vos mots de passe sont différents.</p>";

        // Fin du script
        exit;
    }

    // Si toutes les conditions sont remplis
    if(!empty($username) && strlen($username) < 21 && !empty($mail) && strlen($mail) < 81 && !empty($mdp) && strlen($mdp) > 11 && strlen($mdp) < 100 && !empty($répé_mdp) && strlen($répé_mdp) > 11 && strlen($répé_mdp) < 100 && $mdp === $répé_mdp)
    {
        // On essai d'enregistrer un nouveau compte
        try
        {
            // Connexion à la DB
            include_once("connexion_db.php");

            // Début de la transaction
            pg_query($db, "BEGIN");

            // Cryptage du mot de passe
            $mdp_crypt = password_hash($mdp, PASSWORD_DEFAULT);

            // Préparation à l'insertion du compte dans la DB
            $prepa_insertion_compte = "INSERT INTO utilisateurs (username, mail, crypt_pwd) VALUES ($1, $2, $3)";

            // Liaison des variables de préparation aux variables du formulaire et exécution
            $insertion_compte = pg_query_params($db, $prepa_insertion_compte, [$username, $mail, $mdp_crypt]);

            // Si l'insertion échoue
            if(!$insertion_compte) 
            {
                // Afficher un message d'erreur
                echo "<p>Erreur pendant l'enregistrement de votre compte: " . pg_last_error($db).".</p>";

                // Annulation de la transaction
                pg_query($db, "ROLLBACK");

                // Fin du script
                exit;
            }

            // Lancement de la transaction
            pg_query($db, "COMMIT");

            // Début de la session
            session_start();

            // Création des variables de session
            $_SESSION["username"] = $username;
            $_SESSION["mail"] = $mail;

            // Redirection vers la page de profil
            header("Location: profile.php");
        }
     
        // Si l'enregistrement d'un nouveau compte échoue
        catch(Exception $exc)
        {
            // Annulation de la transaction
            pg_query($db, "ROLLBACK");

            // Affichage de toutes les erreurs
            error_reporting(E_ALL);

            // Affichage d'un message d'erreur à l'utilisateur
            echo "<p>Exception apparu pendant la création de votre compte : " . $exc . ". Opération annulée.</p>";

            // Fin du script
            exit;
        }
    }
?>