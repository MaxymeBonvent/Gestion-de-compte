// Fonction pour supprimer un compte après un avertissement
function AlerteSuppressionCompte(username)
{
    // Message test
    console.log("Fonction AlerteSuppressionCompte() lancée.");

    // On avertit l'utilisateur qu'il s'apprête à supprimer son compte
    let supprimer = confirm("ATTENTION! Vous êtes sur le point de SUPPRIMER votre compte. Cette opération ne peut être annulée une fois confirmée. Êtes-vous sûr?");

    // Si l'utilisateur clique sur "Annuler"
    if(!supprimer)
    {
        console.log("Ne pas supprimer.");
    }

    // Si l'utilisateur clique sur "OK"
    else
    {
        console.log(`${username} veut supprimer son compte.`);
    }
}