<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion de compte - Nouveau compte</title>
    <link rel="stylesheet" href="../CSS/nouveau_compte.css">

</head>

<body>

    <header>

        <nav>

            <a href="accueil.php">Accueil</a>
            <a href="form_connexion.php">Se connecter</a>

        </nav>

    </header>

    <main>

        <h1>Nouveau compte</h1>

        <form action="inscription.php" method="POST">

            <div>
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" placeholder="nom" oninput="LongueurNom()">
            </div>

            <p><span id="longueur_nom">0</span>/20</p>

            <p id="dispo_nom">Nom &#40;in&#41;disponible</p>

            <div>
                <label for="mail">Mail</label>
                <input type="email" name="mail" id="mail" placeholder="une.adresse@hotmail.com" oninput="LongueurMail()">
            </div>

            <p><span id="longueur_mail">0</span>/80</p>

            <p id="dispo_mail">Mail &#40;in&#41;disponible</p>

            <div>
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" placeholder="************" oninput="ConditionsMDP()">
            </div>

            <p>Votre mot de passe doit contenir au moins :</p>

            <ul>
                <li id="txt_longueur">12 caractères</li>
                <li id="txt_maj">1 majuscule</li>
                <li id="txt_min">1 minuscule</li>
                <li id="txt_chiffre">1 chiffre</li>
                <li id="txt_spec">1 caractère spécial &#40;sauf &&#41;</li>
            </ul>

            <div>
                <label for="répé_mdp">Répéter mdp</label>
                <input type="password" name="répé_mdp" id="répé_mdp" placeholder="************" oninput="TestToutesConditions()">
            </div>

            <p id="compar_mdp">Les mots de passe sont identiques/différents</p>

            <input type="submit" name="btn_nouveau_compte" id="btn_nouveau_compte" value="Créer un compte">

        </form>

        <p>Vous avez déjà un compte? <a href="form_connexion.php">Cliquez ici</a>.</p>

    </main>

    <footer>
        <p>&copy; Site web développé par Maxyme Bonvent.</p>
    </footer>    

    <script src="../JS/conditions_mdp_nouveau_compte.JS"></script>

</body>
</html>