<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion de compte - Accueil</title>
    <link rel="stylesheet" href="../CSS/accueil.css">

</head>

<body>

    <header>

        <nav>

            <a href="accueil.php" style="background-color: dodgerblue; color: black; padding: 4px;">Accueil</a>

            <?php
                // Début de session
                session_start();

                // Affichage de toutes les erreurs
                error_reporting(E_ALL);
                ini_set("display_errors", 1);

                // Si l'utilisateur est connecté
                if(isset($_SESSION["username"]))
                {
                    // Afficher le lien vers sa page de profile
                    echo "<a href='profile.php'>Profile</a>";
                }

                // Si l'utilisateur n'est pas connecté
                else
                {
                    // Afficher le lien vers la page de connexion
                    echo "<a href='form_connexion.php'>Se connecter</a>";
                }
            ?>
            
        </nav>

    </header>

    <main>

        <h1>Accueil</h1>

        <p>Bienvenu sur ce projet de gestionnaire de comptes. Ici, vous pouvez créer votre compte, vous déconnecter, vous reconnecter, modifier votre mot de passe, en demander un nouveau, ou supprimer votre compte.</p>

    </main>

    <footer>
        <p>&copy; Site web développé par Maxyme Bonvent.</p>
    </footer>    

</body>
</html>