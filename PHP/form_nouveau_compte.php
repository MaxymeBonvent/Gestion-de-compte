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

            <!-- NOM -->
            <div>
                <label for="username">Nom</label>
                <input type="text" name="username" id="username" placeholder="nom" minlength="1" maxlength="20" oninput="LongueurNom()">
            </div>

            <p><span id="longueur_nom">0</span>/20</p>

            <p id="dispo_nom">Nom &#40;in&#41;disponible</p>

            <!-- MAIL -->
            <div>
                <label for="mail">Mail</label>
                <input type="email" name="mail" id="mail" placeholder="une.adresse@hotmail.com" minlength="14" maxlength="80" oninput="LongueurMail()">
            </div>

            <p><span id="longueur_mail">0</span>/80</p>

            <p id="dispo_mail">Mail &#40;in&#41;disponible</p>

            <!-- MOT DE PASSE -->
            <div>
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" placeholder="************" minlength="12" maxlength="100" oninput="ConditionsMDP()">
            </div>

            <p>Votre mot de passe doit contenir au moins :</p>

            <ul>
                <li id="txt_longueur">12 caractères</li>
                <li id="txt_maj">1 majuscule</li>
                <li id="txt_min">1 minuscule</li>
                <li id="txt_chiffre">1 chiffre</li>
                <li id="txt_spec">1 caractère spécial &#40;sauf &&#41;</li>
            </ul>

            <!-- RÉPÉTITION DU MOT DE PASSE -->
            <div>
                <label for="répé_mdp">Répéter mdp</label>
                <input type="password" name="répé_mdp" id="répé_mdp" placeholder="************" minlength="12" maxlength="100" oninput="TestToutesConditions()">
            </div>

            <p id="compar_mdp">Les mots de passe sont identiques/différents</p>

            <!-- VALIDATION -->
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