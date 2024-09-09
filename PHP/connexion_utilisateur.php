<?php
    // Début de session
    session_start();

    // Couleur du texte sur la page d'erreur
    $couleur_txt = "rgb(180, 180, 180)";

    // Encodage
    header('Content-Type: text/html; charset=utf-8');
    
    // Affichage de toutes les erreurs
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    // --- VARIABLES DU FORMULAIRE --- //
    $username = trim($_POST["username"]);
    $mdp = trim($_POST["mdp"]);

    // STYLE DE LA PAGE
    echo "<body style='background-color: black;'>";

    // --- ERREUR SESSION --- //

    // Si l'utilisateur est déjà connecté
    if (isset($_SESSION['username'])) 
    {
        // Afficher un message d'erreur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : vous êtes déjà connecté.</p>";

        // Fin du script
        exit;
    }

    // --- ERREURS NOM --- //

    // Si le nom est inexistant
    if(empty($username))
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : aucun nom donné.</p>";

        // Fin du script
        exit;
    }

    // Si le nom est trop long
    if(strlen($username) > 20)
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : le nom est de taille supérieur à 20 caractères.</p>";

        // Fin du script
        exit;
    }

    // --- ERREURS MOT DE PASSE --- //

    // Si le mdp est inexistant
    if(empty($mdp))
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : aucun mot de passe donné.</p>";

        // Fin du script
        exit;
    }

    // Si le mdp est trop long
    if(strlen($mdp) > 100)
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : le mot de passe est de taille supérieur à 100 caractères.</p>";

        // Fin du script
        exit;
    }

    // --- FORMULAIRE VALIDE --- //
    if(!empty($username) && strlen($username) < 21 && !empty($mdp) && strlen($mdp) < 101)
    {
        // Connexion à la DB
        include_once("connexion_db.php");
        
        // Requête pour sélectionner le mdp crypté de la DB qui correspond au nom du formulaire
        $mdp_nom = "SELECT username, crypt_pwd FROM utilisateurs WHERE username = $1;";

        // Exécution
        $exec_mdp_nom = pg_query_params($db, $mdp_nom, array($username));

        // Si l'exécution rate
        if (!$exec_mdp_nom) 
        {
            // On affiche un message d'erreur
            echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur de requête : " . pg_last_error($db) . "</p>";

            // Fin du script
            exit;
        }

        // Si l'exécution renvoi au moins une rangée
        if($rangee_mdp_nom = pg_fetch_assoc($exec_mdp_nom))
        {
            // On place le mdp crypté et trimé de la DB dans une variable
            $mdp_db_crypt = trim($rangee_mdp_nom["crypt_pwd"]);

            // Si le cryptage du mdp du formulaire correspond au mdp crypté de la DB 
            if(password_verify($mdp, $mdp_db_crypt))
            {
                // Message de réussite de la connexion
                // echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Les MDP du formulaire et de la DB correspondent. Vous allez être redirigé vers votre page de profile.</p>";

                // On assigne à la varibale globale SESSION["username"] la valeur du nom du formulaire
                $_SESSION["username"] = $username;

                // Redirection
                header("Location: profile.php");

                // Fin du script
                exit;
            }

            // Si la connexion échoue
            else
            {
                // Message d'échec de la connexion
                echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Échec de la connexion, les MDP du formulaire et de la DB ne correspondent pas.</p>";

                // Fin du script
                exit;
            }
        }

        // Si l'exécution ne renvoi aucune rangée
        else
        {
            // Afficher un message d'erreur
            echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : nom ou mot de passe inconnu.</p>";

            // Fin du script
            exit;
        }
    }

    // STYLE DE LA PAGE
    echo "</body>";
?>