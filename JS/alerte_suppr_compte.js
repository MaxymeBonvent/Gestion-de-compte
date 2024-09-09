// Fonction pour supprimer un compte après un avertissement
function AlerteSuppressionCompte(username)
{
    // On avertit l'utilisateur qu'il s'apprête à supprimer son compte
    let supprimer = confirm("ATTENTION! Vous êtes sur le point de SUPPRIMER votre compte. Cette opération ne peut être annulée une fois confirmée. Êtes-vous sûr?");

    // Si l'utilisateur clique sur "Annuler"
    if(!supprimer)
    {
        console.log(`${username} ne veut pas supprimer son compte.`);

        // Fin de la fonction
        return 0;
    }

    // Si l'utilisateur clique sur "OK"
    else
    {
        // Objet XML
        const xhr = new XMLHttpRequest();

        // Objet Data
        const data = new FormData();

        // Ajout du nom de l'utilisateur en tant que donnée
        data.append("username", username);

        // Affichage de toutes les pairs clé-valeur de data
        for(const [key, value] of data.entries())
        {
            console.log(`key : ${key} - value : ${value}.`);
        }
        

        // Ouverture du script PHP de suppression de compte
        xhr.open("POST", `suppression_compte.php`);

        // Fonction de chargement de la requête
        xhr.onload = function()
        {  
            // Si la requête réussi
            if(xhr.status == 200)
            {
                // Afficher sa réponse
                console.log(this.responseText);

                // Redirection
                window.location.href = "confirm_suppr_compte.php";
            }

            // Si la requête n'a pas le statut 200
            else
            {
               // Afficher un message d'erreur
                console.log(`Erreur : ${this.responseText}`); 

                // Fin de la fonction
                return 0;
            }
        }

        // Si la requête échoue
        xhr.onerror = function()
        {
            // Afficher un message d'erreur
            console.log(`Erreur lors de la requête de suppression du compte.`);

            // Fin de la fonction
            return 0;
        }

        // Envoi des données
        xhr.send(data);
    }
}