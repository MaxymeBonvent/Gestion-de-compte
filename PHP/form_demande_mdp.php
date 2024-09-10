<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion de compte - Formulaire de demande de nouveau mot de passe</title>
    <link rel="stylesheet" href="../CSS/connexion.css">

</head>

<body>

    <header>

        <nav>

            <a href="accueil.php">Accueil</a>
            <a href="form_connexion.php" style="background-color: dodgerblue; color: black; padding: 4px;">Se connecter</a>

        </nav>

    </header>

    <main>

        <h1>Formulaire de demande de nouveau mot de passe</h1>

        <form method="POST" action="confirm_demande_nouveau_mdp.php">

            <div>
                <label for="username">Nom</label>
                <input type="text" id="username" placeholder="nom" autocomplete="off" required>
            </div>

            
            <div>
                <label for="email">Mail</label>
                <input type="mail" id="email" placeholder="une.adresse@hotmail.com" autocomplete="off" required>
            </div>

            <input id="btn_demande_mdp" type="submit" value="Demander un nouveau mot de passe">

        </form>

    </main>

    <footer>
        <p>&copy; Site web développé par Maxyme Bonvent.</p>
    </footer>    

</body>
</html>