<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion de compte - Se connecter</title>
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

        <h1>Se connecter</h1>

        <form action="connexion_utilisateur.php" method="POST">

            <div>
                <label for="username">Nom</label>
                <input type="text" name="username" id="username" placeholder="nom" minlength="1" maxlength="20" autocomplete="off" required>
            </div>
            
            <div>
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" placeholder="************" minlength="12" maxlength="100" autocomplete="off" required>
            </div>

            <input id="btn_connexion" type="submit" value="Connexion">

        </form>

        <p>Vous n'avez pas encore de compte? <a href="form_nouveau_compte.php">Cliquez ici</a>.</p>
        <p>Vous avez oublié votre mot de passe? <a href="form_demande_mdp.php">Cliquez ici</a>.</p>

    </main>

    <footer>
        <p>&copy; Site web développé par Maxyme Bonvent.</p>
    </footer>    

</body>
</html>