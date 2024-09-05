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

        <h1>Pseudo</h1>

        <div>

            <a href="form_changement_mdp.php">Changer le mot de passe</a>
            <a href="confirm_deconnexion.php">Se déconnecter</a>
            <a id="lien_suppr_compte" href="confirm_suppr_compte.php">Supprimer le compte</a>

        </div>

        <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            session_start();
            
            if($_SESSION["username"] == "admin")
            {
               echo "<h1>Fonctions admin</h1>";
            }

            else
            {
                echo "<p>Vous n'êtes pas admin.</p>";
            }
        ?>

    </main>

    <footer>
        <p>&copy; Site web développé par Maxyme Bonvent.</p>
    </footer>    

</body>
</html>