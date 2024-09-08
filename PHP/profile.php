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
            
            // Si le nom de l'utilisateur existe
            if(isset($_SESSION["username"]))
            {
                // Le placer dans une variable
                $username = $_SESSION["username"];

                // Affichage du nom de l'utilisateur à l'écran
                echo "<h1>".$username."</h1>";
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

        <div>

            <a href="form_changement_mdp.php">Changer le mot de passe</a>
            <a href="confirm_deconnexion.php">Se déconnecter</a>
            <a id="lien_suppr_compte" href="confirm_suppr_compte.php">Supprimer le compte</a>

        </div>

    </main>

    <footer>
        <p>&copy; Site web développé par Maxyme Bonvent.</p>
    </footer>    

</body>
</html>