<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion de compte - Profile</title>
    <link rel="stylesheet" href="../CSS/profile.css">

</head>

<body>

    <header>

        <nav>

            <a href="accueil.php" >Accueil</a>
            <a href="profile.php" style="background-color: dodgerblue; color: black; padding: 4px;">Profile</a>

        </nav>

    </header>

    <main>

        <?php
            // Début de la session
            session_start();

            // Affichage de toutes les erreurs
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            // Si la variable globale SESSION["username"] existe
            if(isset($_SESSION["username"]))
            {
                // Placer sa valeur dans une variable
                $username = htmlspecialchars($_SESSION["username"]);

                // Affichage du nom de l'utilisateur à l'écran
                echo "<h1>".$username."</h1>";

                // Affichage des options du compte
                echo "<div>

                        <a href='form_changement_mdp.php' class='option_compte'>Changer le mot de passe</a>
                        <a href='confirm_deconnexion.php' class='option_compte'>Se déconnecter</a>
                        <a style='text-decoration: underline;' class='option_compte' onclick='AlerteSuppressionCompte(\"$username\")'>Supprimer le compte</a>

                    </div>";
            }

            // Si le nom de l'utilisateur n'existe pas
            else
            {
                // Afficher un message d'erreur
                echo "<p>Erreur : aucun nom d'utilisateur.</p>";

                // Fin du script
                exit;
            }
        ?>

    </main>

    <footer>
        <p>&copy; Site web développé par Maxyme Bonvent.</p>
    </footer>  
    
    <script src="../JS/alerte_suppr_compte.js"></script>

</body>
</html>