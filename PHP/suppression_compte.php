<?php
    // Affichage de toutes les erreurs
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    // Encodage
    header('Content-Type: text/html; charset=utf-8');

    // Couleur du texte
    $couleur_txt = "rgb(180, 180, 180)";

    // DÉBUT DE PAGE
    echo "<html><body style='background-color: black;'>";   

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

    // Variables du compte à supprimer
    $username = trim($_POST["username"]);

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

    // --- FORMULAIRE VALIDE --- //
    
    if(isset($_POST["username"]) && !empty($username) && strlen($username) < 21)
    {
        // Connexion à la DB
        include_once("connexion_db.php");

        // Requête de suppression du compte
        $suppr_compte = "DELETE FROM utilisateurs WHERE username = $1";

        // Préparation
        $prepa_suppr_compte = pg_prepare($db, "suppr_compte", $suppr_compte);

        // Exécution
        $exec_suppr_compte = pg_execute($db, $suppr_compte, array($username));

        // Si l'exécution a échoué
        if(!$exec_suppr_compte)
        {
            // Afficher un message d'erreur
            echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Échec de la suppression du compte.</p>";

            // Fin du script
            exit;
        }

        // Si l'exécution a réussi
        else
        {
            // Afficher un message de confirmation
            echo "<p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Réussite de la suppression du compte.</p>";

            // Fin du script
            exit;
        }
    }
    
    // FIN DE PAGE
    echo "</body></html>";
?>