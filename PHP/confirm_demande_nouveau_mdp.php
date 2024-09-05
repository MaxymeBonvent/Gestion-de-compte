<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion de compte - Demande de nouveau mot de passe</title>
    <link rel="stylesheet" href="../CSS/confirm.css">

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
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            echo "<p>Un mail vient d'être envoyé à un administrateur pour signaler votre oublie de mot de passe. <br> Un mail contenant votre nouveau mot de passe vous sera envoyé.</p>";
        ?>

    </main>

    <footer>
        <p>&copy; Site web développé par Maxyme Bonvent.</p>
    </footer>    

</body>
</html>