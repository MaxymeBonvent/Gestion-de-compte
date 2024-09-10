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
            
            // Si la variable globale SESSION["username"] existe
            if(isset($_SESSION["username"]))
            {
                // Placer sa valeur dans une variable
                $username = htmlspecialchars($_SESSION["username"]);

                // Affichage du nom de l'utilisateur à l'écran
                echo "<h1>".$username."</h1>";

                // Affichage des options du compte
                echo "<div>

                        <a href='form_changement_mdp.php' class='option_compte'>Changer le mot de passe</a>
                        <a href='confirm_deconnexion.php' class='option_compte'>Se déconnecter</a>
                        <a style='text-decoration: underline;' class='option_compte' onclick='AlerteSuppressionCompte(\"$username\")'>Supprimer le compte</a>

                    </div>";

                // FONCTIONS ADMIN
                if($username === "admin")
                {
                    echo "<h2>Fonctions admin</h2>";

                    // Connexion à la DB
                    include_once("connexion_db.php");

                    // Requête d'obtention de la table utilisateurs
                    $utilisateurs = "SELECT username, id FROM utilisateurs ORDER BY id ASC";

                    // Exécution
                    $exec_utilisateurs = pg_query($db, $utilisateurs);

                    // Si l'exécution échoue
                    if(!$exec_utilisateurs)
                    {
                        // Afficher un message d'erreur
                        echo "<p>Échec de l'exécution de la requête d'obtention de la table utilisateurs</p>";

                        // Fin du script
                        exit;
                    }

                    // Si l'exécution réussi
                    else
                    {
                        // Stocker les données dans un array
                        $données_utilisateurs = pg_fetch_all($exec_utilisateurs);
                        // echo count($données_utilisateurs);
                        // echo $données_utilisateurs[0]["username"]; 
                        // var_dump($données_utilisateurs[0]["username"]);

                        // DÉBUT DU TABLEAU
                        echo "<table>";

                            // Légende
                            echo "<caption>Données utilisateurs</caption>";

                            // Rangée des têtes de colonnes
                            echo "  <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Changer mdp</th>
                                        </tr>
                                    </thead>";

                            // Début du corps
                            echo "<tbody>";

                            for($u = 0; $u < count($données_utilisateurs); $u++)
                            {
                                // Début de rangée
                                echo "<tr>";

                                    echo "<td>".$données_utilisateurs[$u]["id"]."</td>";
                                    echo "<td class='noms_utilisateurs'>".$données_utilisateurs[$u]["username"]."</td>";
                                    echo "<td><input type='checkbox' class='check' name='mdp_check' onclick='CompteCasesCochées()'></td>";

                                // Fin de rangée
                                echo "</tr>";
                            }

                            // Fin du corps
                            echo "</tbody>";

                        // FIN DU TABLEAU
                        echo "</table>";
                    }

                    // Nombre de mot de passe à modifier
                    echo "<p>Modifier <span id='txt_nb_mdp_admin'>0</span> mots de passe.</p>";


                    // FORMULAIRE DE CHANGEMENT DES MOTS DE PASSE
                    echo "<form id='form_mdps_admin' method='POST' action='admin_changer_mdps.php'>";

                        echo "<span id='champs_utilisateurs'></span>";

                        echo "<input type='submit' value='Changer les mots de passe'>";

                    echo "</form>";
                }
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

    </main>

    <footer>
        <p>&copy; Site web développé par Maxyme Bonvent.</p>
    </footer>  
    
    <script src="../JS/alerte_suppr_compte.js"></script>
    <script src="../JS/nb_mdp_changer_admin.js"></script>

</body>
</html>