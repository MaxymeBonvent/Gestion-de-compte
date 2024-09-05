<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion de compte - Formulaire de changement de mot de passe</title>
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

        <h1>Formulaire de changement de mot de passe</h1>

        <form action="changement_mdp.php">

            <div>
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" placeholder="nom" oninput="Nom()">
            </div>

            <div>
                <label for="mdp_actuel">Mot de passe actuel</label>
                <input type="password" name="mdp_actuel" id="mdp_actuel" placeholder="************" oninput="mdpActuel()">
            </div>

            <div>
                <label for="nouveau_mdp">Nouveau mot de passe</label>
                <input type="password" name="nouveau_mdp" id="nouveau_mdp" placeholder="************" oninput="ConditionsNouveauMDP()">
            </div>

            <p>Votre nouveau mot de passe doit contenir au moins :</p>

            <ul>
                <li id="txt_longueur">12 caractères</li>
                <li id="txt_maj">1 majuscule</li>
                <li id="txt_min">1 minuscule</li>
                <li id="txt_chiffre">1 chiffre</li>
                <li id="txt_spec">1 caractère spécial &#40;sauf &&#41;</li>
            </ul>

            <div>
                <label for="nouveau_mdp_rép">Répéter nouveau mdp</label>
                <input type="password" name="nouveau_mdp_rép" id="nouveau_mdp_rép" placeholder="************" oninput="TestToutesConditions()">
            </div>

            <p id="txt_compar_mdp">Les mots de passe sont identiques/différents</p>

            <input type="submit" name="btn_nouveau_mdp" id="btn_nouveau_mdp" value="Changer le mot de passe">

        </form>

    </main>

    <footer>
        <p>&copy; Site web développé par Maxyme Bonvent.</p>
    </footer>
    
    <script src="../JS/conditions_mdp_form_changer_mdp.js"></script>

</body>
</html>