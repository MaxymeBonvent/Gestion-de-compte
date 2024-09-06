<?php
    // Variables du formulaire
    $username = $_POST["username"];
    $mdp = $_POST["mdp"];

    // --- ERREURS NOM --- //

    // Si le nom est inexistant
    if(empty($username))
    {
        // Le dire à l'utilisateur
        echo "<p>Erreur : aucun nom donné.</p>";

        // Fin du script
        exit;
    }

    // Si le nom est trop long
    if(strlen($username) > 20)
    {
        // Le dire à l'utilisateur
        echo "<p>Erreur : le nom est de taille supérieur à 20 caractères.</p>";

        // Fin du script
        exit;
    }

    // --- ERREURS MOT DE PASSE --- //

    // Si le mdp est inexistant
    if(empty($mdp))
    {
        // Le dire à l'utilisateur
        echo "<p>Erreur : aucun mot de passe donné.</p>";

        // Fin du script
        exit;
    }

    // Si le mdp est trop long
    if(strlen($mdp) > 80)
    {
        // Le dire à l'utilisateur
        echo "<p>Erreur : le mot de passe est de taille supérieur à 80 caractères.</p>";

        // Fin du script
        exit;
    }

    // --- FORMULAIRE VALIDE --- //
    if(!empty($username) && strlen($username) < 21 && !empty($mdp) && strlen($mdp) < 81)
    {
        // Connexion à la DB
        include_once("connexion_db.php");
        
        // Requête pour sélectionner le mdp crypté correspondant au nom du formulaire
        $mdp_nom = "SELECT crypt_pwd FROM utilisateurs WHERE username = $1";

        // Préparation
        $prepa_mdp_nom = pg_prepare($db, "mdp_nom", $mdp_nom);

        // Exécution
        $exec_mdp_nom = pg_execute($db, "mdp_nom", array($username));

        // Si l'exécution renvoi au moins une rangée
        if($exec_mdp_nom)
        {
            // La placer dans une array
            $rangée_mdp_nom = pg_fetch_assoc($exec_mdp_nom);

            // TEST
            echo "<p style='text-align: left; font-size: 20px;'>Mot de passe du formulaire : " . htmlspecialchars($mdp) . "</p>";
            echo "<p style='text-align: left; font-size: 20px;'>Mot de passe du formulaire hashé : " . password_hash($mdp, PASSWORD_DEFAULT) . "</p>";
            echo "<p style='text-align: left; font-size: 20px;'>Mot de passe de la DB : " . htmlspecialchars($rangée_mdp_nom["crypt_pwd"]) . "</p>";

            // Si la rangée n'existe pas
            if(!$rangée_mdp_nom)
            {
                // Message d'erreur
                echo "<p style='text-align: center; font-size: 20px;'>Erreur: aucune rangée de la base de donnée ne contient ce nom et ce mot de passe ensemble.</p>";

                // Fin du script
                exit;
            }
           
            // Si le hash du mdp du formulaire correspond au mdp crypté de la DB 
            if(password_verify($mdp, $rangée_mdp_nom["crypt_pwd"]))
            {
                // Message de réussite de la connexion
                echo "<p style='text-align: center; font-size: 20px;'>Réussite de la connexion.</p>";

                // Fin du script
                exit;
            }

            // Si la connexion échoue
            else
            {
                // Message d'échec de la connexion
                echo "<p style='text-align: center; font-size: 20px;'>Échec de la connexion, le mot de passe donnée n'existe pas dans la DB.</p>";

                // Fin du script
                exit;
            }
        }
    }
?>