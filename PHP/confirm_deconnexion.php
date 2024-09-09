<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion de compte - Déconnexion</title>
    <link rel="stylesheet" href="../CSS/confirm.css">

</head>

<body>

    <header>

        <nav>

            <a href="accueil.php" >Accueil</a>
            <a href="form_connexion.php" style="background-color: dodgerblue; color: black; padding: 4px;">Se connecter</a>

        </nav>

    </header>

    <main>

    <?php
        // Début de session
        session_start();

        // Affichage de toutes les erreurs
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        // Fin de session
        session_destroy();

        // Message de confirmation
        echo "<p>Vous êtes bien déconnecté.</p>";
    ?>

    </main>

    <footer>
        <p>&copy; Site web développé par Maxyme Bonvent.</p>
    </footer>    

</body>
</html>