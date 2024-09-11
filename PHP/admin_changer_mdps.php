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

    // Connexion à la DB
    include_once("connexion_db.php");

    // DÉBUT DE PAGE
    echo "<!DOCTYPE html><html lang='fr'><body style='background-color: black;'>";

        // --- ERREURS FORMULAIRE --- //

        // Si la méthode n'est pas POST
        if($_SERVER["REQUEST_METHOD"] !== "POST")
        {
            // Afficher un message d'erreur
            echo "<pre style='color : $couleur_txt; text-align: center; font-size: 20px;'>Erreur : la méthode utilisé n'est pas POST.</pre>";

            // Fin du script
            exit;
        }

        // Début d'affichage
        echo "<pre style='color : $couleur_txt; text-align: center; font-size: 20px;'>";

            // --- PRÉPARATION DE LA REQUÊTE --- //

            // Requête de changement de mdp
            $changer_mdp = "UPDATE utilisateurs SET crypt_pwd = $1 WHERE username = $2";

            // Préparation
            $prepa_changer_mdp = pg_prepare($db, "changer_mdp", $changer_mdp);

            // Pour chaque pair clé-valeur ["nom_utilisateur]-"Utilisateur" ET ["mdp_utilisateur]-"***"
            foreach($_POST as $key => $value)
            {
                // --- ERREURS NOMS --- //

                // Si la clé commence par "nom_"
                if(strpos($key, "nom_") === 0)
                {
                    // S'il n'y a aucun nom
                    if(empty($value))
                    {   
                        // Afficher un message d'erreur
                        echo "Erreur : aucun nom.";

                        // Fin du script
                        exit;
                    }

                    // Si le nom est trop long
                    else if(strlen($value) > 20)
                    {   
                        // Afficher un message d'erreur
                        echo "Erreur : le nom " .$value. " > 20 caractères.";

                        // Fin du script
                        exit;
                    }
                }

                // --- ERREURS NOUVEAUX MOT DE PASSES --- //

                // Si la clé commence par "mdp_"
                if(strpos($key, "mdp_") === 0)
                {
                    // S'il n'y a aucun mdp
                    if(empty($value))
                    {   
                        // Afficher un message d'erreur
                        echo "Erreur : aucun nouveau mot de passe.";

                        // Fin du script
                        exit;
                    }

                    // Si le nouveau mdp est trop court
                    else if(strlen($value) < 12)
                    {   
                        // Afficher un message d'erreur
                        echo "Erreur : le nouveau mdp < 12 caractères.";

                        // Fin du script
                        exit;
                    }

                    // Si le nouveau mdp est trop long
                    else if(strlen($value) > 100)
                    {   
                        // Afficher un message d'erreur
                        echo "Erreur : le nouveau mdp > 100 caractères.";

                        // Fin du script
                        exit;
                    }

                    // --- FORMULAIRE VALIDE --- //
                    else
                    {
                        // Si la clé commence par "mdp_"
                        if(strpos($key, "mdp_") === 0)
                        {
                            // On obtient le nom de l'utilisateur en effaçant "mdp_"
                            $utilisateur = str_replace("mdp_", "", $key);

                            // On obtient le nouveau mdp qui est la valeur dans la pair
                            $nouveau_mdp = trim($value);

                            // Affichage de la pair
                            echo "Nom : " . $utilisateur . ", nouveau mdp : " . $nouveau_mdp . ".\n";

                            // Cryptage du nouveau mdp
                            $nouveau_mdp_crypt = password_hash($nouveau_mdp, PASSWORD_DEFAULT);

                            // --- CHANGEMENT DE MOT DE PASSE POUR L'UTILISATEUR EN COURS --- //

                            // Début de transaction
                            pg_query($db, "BEGIN");

                            // Exécution
                            $exec_changer_mdp = pg_execute($db, "changer_mdp", array($nouveau_mdp_crypt, $utilisateur));

                            // Si l'exécution échoue
                            if(!$exec_changer_mdp)
                            {
                                // Annulation de la transaction
                                pg_query($db, "ROLLBACK");

                                // Afficher un message d'erreur
                                echo "Échec de l'exécution de la requête de changement de mdp pour l'utilisateur " . $utilisateur . ".";

                                // Fin du script
                                exit;
                            }

                            // Si l'exécution réussi
                            else
                            {
                                // Lancement de la transaction
                                pg_query($db, "COMMIT");
                            }
                        }
                    }
                }  
            }

            // Message de réussite de toutes les transactions
            echo "Toutes les transactions ont réussi.";

        // Fin d'affichage
        echo "</pre>";
        
    // FIN DE PAGE
    echo "</body></html>";
?>