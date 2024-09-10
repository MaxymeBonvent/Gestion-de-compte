<?php
    // Affichage de toutes les erreurs
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    // Encodage
    header('Content-Type: text/html; charset=utf-8');

    // Couleur du texte
    $couleur_txt = "rgb(180, 180, 180)";

    // DÉBUT DE PAGE
    echo "<!DOCTYPE html><html lang='fr'><body style='background-color: black;'>";

    // --- ERREURS FORMULAIRE --- //

    // Si la requête n'est pas de type POST
    if($_SERVER["REQUEST_METHOD"] !== "POST")
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : la méthode n'est pas de type POST.</p>";

        // Fin du script
        exit;
    }

    // S'il n'y a aucun nom
    if(!isset($_POST["username"]))
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : aucune variable \$_POST['username'].</p>";

        // Fin du script
        exit;
    }

    // S'il n'y a aucun mdp actuel
    if(!isset($_POST["mdp_actuel"]))
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : aucune variable \$_POST['mdp_actuel'].</p>";

        // Fin du script
        exit;
    }

    // S'il n'y a aucun nouveau mdp
    if(!isset($_POST["nouveau_mdp"]))
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : aucune variable \$_POST['nouveau_mdp'].</p>";

        // Fin du script
        exit;
    }

    // S'il n'y a aucun nouveau mdp répété
    if(!isset($_POST["nouveau_mdp_rep"]))
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : aucune variable \$_POST['nouveau_mdp_rep'].</p>";

        // Fin du script
        exit;
    }

    // Variables du compte dont le mdp doit être changé
    $username = trim($_POST["username"]);
    $mdp_actuel = trim($_POST["mdp_actuel"]);
    $nouveau_mdp = trim($_POST["nouveau_mdp"]);
    $nouveau_mdp_rep = trim($_POST["nouveau_mdp_rep"]);

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

    // --- ERREURS MOT DE PASSE ACTUEL --- //

    // Si le mdp_actuel est inexistant
    if(empty($mdp_actuel))
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : aucun mot de passe actuel donné.</p>";

        // Fin du script
        exit;
    }

    // Si le mdp_actuel est trop long
    if(strlen($mdp_actuel) > 100)
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : le mot de passe actuel est de taille supérieur à 100 caractères.</p>";

        // Fin du script
        exit;
    }

    // --- ERREURS NOUVEAU MOT DE PASSE --- //

    // Si le nouveau_mdp est inexistant
    if(empty($nouveau_mdp))
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : aucun nouveau mot de passe donné.</p>";

        // Fin du script
        exit;
    }

    // Si le nouveau_mdp est trop long
    if(strlen($nouveau_mdp) > 100)
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : le nouveau mot de passe est de taille supérieur à 100 caractères.</p>";

        // Fin du script
        exit;
    }

    // --- ERREURS NOUVEAU MOT DE PASSE RÉPÉTÉ --- //

    // Si le nouveau_mdp_rep est inexistant
    if(empty($nouveau_mdp_rep))
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : aucun nouveau mot de passe répété donné.</p>";

        // Fin du script
        exit;
    }

    // Si le nouveau_mdp_rep est trop long
    if(strlen($nouveau_mdp_rep) > 100)
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : le nouveau mot de passe répété est de taille supérieur à 100 caractères.</p>";

        // Fin du script
        exit;
    }

    // Si les nouveaux mdp sont différents
    if($nouveau_mdp !== $nouveau_mdp_rep)
    {
        // Le dire à l'utilisateur
        echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Erreur : les nouveaux mdp sont différents.</p>";

        // Fin du script
        exit;
    }

    // --- FORMULAIRE VALIDE --- //

    if(!empty($username) && strlen($username) < 21 && !empty($mdp_actuel) && strlen($mdp_actuel) < 101 && !empty($nouveau_mdp) && strlen($nouveau_mdp) < 101 && !empty($nouveau_mdp_rep) && strlen($nouveau_mdp_rep) < 101 && $nouveau_mdp === $nouveau_mdp_rep)
    {
        // Connexion à la DB
        include_once("connexion_db.php");

        // --- ON VÉRIFIE QUE L'UTILISATEUR EXISTE --- //

        // Requête de sélection de l'utilisateur
        $nom_mdp = "SELECT username, crypt_pwd FROM utilisateurs WHERE username = $1";

        // Préparation
        $prepa_nom_nom = pg_prepare($db, "nom_mdp", $nom_mdp);

        // Exécution
        $exec_nom_mdp = pg_execute($db, "nom_mdp", array($username));

        // Si l'exécution échoue
        if(!$exec_nom_mdp)
        {
            // On affiche un message un message d'erreur
            echo "<p style='color: $couleur_txt; font-size: 20px; text-align: center'>Échec de l'exécution de la requête de récupération des info de l'utilisateur.</p>";

            // Fin du script
            exit;
        }

        // Si l'exécution réussi
        else
        {
            // S'il n'existe aucune rangée avec ce nom et ce mdp
            if(pg_num_rows($exec_nom_mdp) < 1)
            {
               // On affiche un message d'inexistence
               echo "<p style='color: $couleur_txt; font-size: 20px; text-align: center'>Erreur : nom ou mot de passe inconnu.</p>";
               
                // Fin du script
                exit;    
            }

            // S'il existe au moins 1 rangée avec ce nom et ce mdp
            else
            {
                // On stock la rangée trouvé en tant qu'array
                $array_nom_mdp = pg_fetch_assoc($exec_nom_mdp);

                // On stock le nom de la DB après trimage
                $nom_DB = trim($array_nom_mdp["username"]);

                // On stock le mdp de la DB après trimage
                $mdp_DB = trim($array_nom_mdp["crypt_pwd"]);

                // Si le nom du formulaire correspond à celui de la DB
                if($username === $nom_DB)
                {
                    // On affiche un message de correspondance
                    echo "<pre style='color: $couleur_txt; font-size: 20px; text-align: center'>Le nom du formulaire correspond à celui de la DB.</pre>";

                    // Si le mdp actuel du formulaire crypté correspond à celui de la DB
                    if(password_verify($mdp_actuel, $mdp_DB))
                    {
                        // On affiche un message de correspondance
                        echo "<pre style='color: $couleur_txt; font-size: 20px; text-align: center'>Le mdp actuel du formulaire correspond à celui de la DB.</pre>";

                        // On affiche un message d'existence de l'utilisateur
                        echo "<pre style='color: $couleur_txt; font-size: 20px; text-align: center'>L'utilisateur existe.</pre>";

                        // --- ON MODIFIE LE MDP DE L'UTILISATEUR --- //

                        // Cryptage du nouveau mdp
                        $nouveau_mdp_crypt = password_hash($nouveau_mdp, PASSWORD_DEFAULT);

                        // Requête de changement du mdp de la DB
                        $change_mdp = "UPDATE utilisateurs SET crypt_pwd = $1 WHERE username = $2";

                        // Préparation
                        $prepa_change_mdp = pg_prepare($db, "change_mdp", $change_mdp);

                        // Exécution
                        $exec_change_mdp = pg_execute($db, "change_mdp", array($nouveau_mdp_crypt, $username));

                        // Si l'exécution échoue
                        if(!$exec_change_mdp)
                        {
                            // Afficher un message d'erreur
                            echo "<pre style='color: $couleur_txt; font-size: 20px; text-align: center'>Échec de l'exécution de la requête de changement de mot de passe.</pre>";

                            // Fin du script
                            exit;
                        }

                        // Si l'exécution réussi
                        else
                        {
                            // Redirection
                            header("Location: confirm_changement_mdp.php");

                            // Fin du script
                            exit;
                        }
                    }
                }
            }  
        }
    }

    // FIN DE PAGE
    echo "</body></html>";
?>