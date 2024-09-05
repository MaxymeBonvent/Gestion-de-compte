// FONDS
let invalide = "rgb(180, 0, 0)";
let valide = "rgb(0, 160, 0)";

// VARIABLE DU NOM
let nom = document.getElementById("nom");
let nomValide = false;

// VARIABLE DU MOT DE PASSE ACTUEL
let mdp_actuel = document.getElementById("mdp_actuel");
let mdpActuelValide = false;

// VARIABLES DU NOUVEAU MOT DE PASSE
let nouveau_mdp = document.getElementById("nouveau_mdp");

// VARIABLES DU NOUVEAU MOT DE PASSE RÉPÉTÉ
let nouveau_mdp_rép = document.getElementById("nouveau_mdp_rép");

// CONDITIONS DU NOUVEAU MOT DE PASSE
let txt_longueur = document.getElementById("txt_longueur");

// Majuscule
let array_maj = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
let majusculePrésente = false;
let txt_maj = document.getElementById("txt_maj");

// Minuscule
let array_min = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
let minusculePrésente = false;
let txt_min = document.getElementById("txt_min");

// Chiffre
let array_chiffre = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
let chiffrePrésent = false;
let txt_chiffre = document.getElementById("txt_chiffre");

// Spécial
let array_spé = ["~", "#", "'", "{", "}", "(", ")", "[", "]", "-", "|", "`", "_", "/", "\\", "\"", "^", "@", "°", "=", "-", "*", ".", "+", "€", "$", "£", "¤", "%", "!", "?", ",", ":"];
let spécialPrésent = false;
let txt_spec = document.getElementById("txt_spec");

// Bool du mot de passe
let nouveauMDPValide = false;

// VARIABLE DE COMPARAISON DES MOTS DE PASSE
let txt_compar_mdp = document.getElementById("txt_compar_mdp");
let mdpsIdentiques = false;

// BOUTON DE VALIDATION
let btn_nouveau_mdp = document.getElementById("btn_nouveau_mdp");
btn_nouveau_mdp.disabled = true;


// --- FONCTIONS --- //

// Fonction pour vérifier que le nom est valide
function Nom()
{
    // Si le champ nom est vide
    if(nom.value.length < 1)
    {
        // L'afficher
        console.log("Le nom est vide.");

        // Invalider le bool du nom
        nomValide = false;
        console.log(`nomValide == ${nomValide}.`);
    }

    // Si le champ nom a plus de 0 caractères
    else if(nom.value.length > 0)
    {
        // L'afficher
        console.log("Le champ nom a au moins 1 caractère.");

        // Valider le bool du nom
        nomValide = true;
        console.log(`nomValide == ${nomValide}.`);
    }
}

// Fonction pour vérifier que le mdp actuel est valide
function mdpActuel()
{
    // Si le champ mdp actuel est vide
    if(mdp_actuel.value.length < 1)
    {
        // L'afficher
        console.log("Le mdp actuel est vide.");

        // Invalider le bool du mdp_actuel
        mdpActuelValide = false;
        console.log(`mdpActuelValide == ${mdpActuelValide}.`);
    }

    // Si le champ mdp actuel a plus de 0 caractères
    else if(mdp_actuel.value.length > 0)
    {
        // L'afficher
        console.log("Le champ mdp actuel a au moins 1 caractère.");

        // Valider le bool du nom
        mdpActuelValide = true;
        console.log(`mdpActuelValide == ${mdpActuelValide}.`);
    }
}

// Fonction pour afficher la longueur du nouveau mdp
function LongueurNouveauMDP()
{  
    // Si le nouveau mdp fait plus de 0 et moins de 12 caractères
    if(nouveau_mdp.value.length > 0 && nouveau_mdp.value.length < 12)
    {
        // Afficher le texte en rouge
        txt_longueur.style.backgroundColor = invalide;

        console.log("Nouveau mot de passe trop court.");
    }

    // Si le nouveau mdp fait au moins de 12 caractères
    else if(nouveau_mdp.value.length > 11)
    {
        // Afficher le texte en vert
        txt_longueur.style.backgroundColor = valide;

        console.log("Nouveau mot de passe d'au moins 12 caractères.");
    }

    // Si le nouveau mdp fait moins de 1 caractères
    else if(nouveau_mdp.value.length < 1)
    {
        // Afficher le texte sans fond
        txt_longueur.style.backgroundColor = "transparent";

        console.log("Nouveau mot de passe vide.");
    }
}

// Fonction pour vérifier qu'au moins 1 majuscule est présente dans le nouveau mot de passe
function Majuscule()
{
    // Si le nouveau mot de passe fait moins de 1 caractère
    if(nouveau_mdp.value.length < 1)
    {
        // Le texte du critère majuscule passe sans fond
        txt_maj.style.backgroundColor = "transparent";
    }

    // Si le nouveau mot de passe fait au moins 1 caractère
    else if(nouveau_mdp.value.length > 0 && !majusculePrésente)
    {
        // Pour chaque caractère du nouveau mot de passe
        for(let char = 0; char < nouveau_mdp.value.length; char++)
        {
            // Pour chaque majuscule
            for(let maj = 0; maj < array_maj.length; maj++)
            {
                // Si un caractère du nouveau mot de passe est une majuscule
                if(nouveau_mdp.value[char] === array_maj[maj])
                {
                    // Le texte du critère majuscule passe en fond vert
                    txt_maj.style.backgroundColor = valide;

                    // On valide le bool majuscule
                    majusculePrésente = true;
                    console.log(`majusculePrésente == ${majusculePrésente}.`);
    
                    // On quitte la boucle
                    break;
                }

                // Si aucun caractère n'est une majuscule
                else
                {
                    // Le texte du critère majuscule passe en fond rouge
                    txt_maj.style.backgroundColor = invalide;
                }
            }
        }
    }
}

// Fonction pour vérifier qu'au moins 1 minuscule est présente dans le nouveau mot de passe
function Minuscule()
{
    // Si le mot de passe fait moins de 1 caractère
    if(nouveau_mdp.value.length < 1)
    {
        // Le texte du critère minuscule passe sans fond
        txt_min.style.backgroundColor = "transparent";
    }

    // Si le nouveau mot de passe fait au moins 1 caractère
    else if(nouveau_mdp.value.length > 0 && !minusculePrésente)
    {
        // Pour chaque caractère du nouveau mot de passe
        for(let char = 0; char < nouveau_mdp.value.length; char++)
        {
            // Pour chaque minuscule
            for(let min = 0; min < array_min.length; min++)
            {
                // Si un caractère du nouveau mot de passe est une minuscule
                if(nouveau_mdp.value[char] === array_min[min])
                {
                    // Le texte du critère minuscule passe en fond vert
                    txt_min.style.backgroundColor = valide;

                    // On valide le bool minsucule
                    minusculePrésente = true;
                    console.log(`minusculePrésente == ${minusculePrésente}.`);
    
                    // On quitte la boucle
                    break;
                }

                // Si aucun caractère n'est une majuscule
                else
                {
                    // Le texte du critère minuscule passe en fond rouge
                    txt_min.style.backgroundColor = invalide;
                }
            }
        }
    }
}

// Fonction pour vérifier qu'au moins 1 chiffre est présent dans nouveau le mot de passe
function Chiffre()
{
    // Si le nouveau mot de passe fait moins de 1 caractère
    if(nouveau_mdp.value.length < 1)
    {
        // Le texte du critère chiffre passe sans fond
        txt_chiffre.style.backgroundColor = "transparent";
    }

    // Si le nouveau mot de passe fait au moins 1 caractère et qu'aucun chiffre n'est encore présent
    else if(nouveau_mdp.value.length > 0 && !chiffrePrésent)
    {
        // Pour chaque caractère du mot de passe
        for(let char = 0; char < nouveau_mdp.value.length; char++)
        {
            // Pour chaque chiffre
            for(let chiffre = 0; chiffre < array_chiffre.length; chiffre++)
            {
                // Si un caractère du nouveau mot de passe est un chiffre
                if(nouveau_mdp.value[char] === array_chiffre[chiffre])
                {
                    // Le texte du critère chiffre passe en fond vert
                    txt_chiffre.style.backgroundColor = valide;

                    // On valide le bool chiffre
                    chiffrePrésent = true;
                    console.log(`chiffrePrésent == ${chiffrePrésent}.`);
    
                    // On quitte la boucle
                    break;
                }

                // Si aucun caractère n'est un chiffre
                else
                {
                    // Le texte du critère chiffre passe en fond rouge
                    txt_chiffre.style.backgroundColor = invalide;
                }
            }
        }
    }
} 

// Fonction pour vérifier qu'au moins 1 caractère spécial est présent dans nouveau le mot de passe
function Spécial()
{
    // Si le nouveau mot de passe fait moins de 1 caractère
    if(nouveau_mdp.value.length < 1)
    {
        // Le texte du critère spécial passe sans fond
        txt_spec.style.backgroundColor = "transparent";
    }

    // Si le nouveau mot de passe fait au moins 1 caractère et qu'aucun caractère spécial n'est encore présent
    else if(nouveau_mdp.value.length > 0 && !spécialPrésent)
    {
        // Pour chaque caractère du nouveau mot de passe
        for(let char = 0; char < nouveau_mdp.value.length; char++)
        {
            // Pour chaque caractère spécial
            for(let spec = 0; spec < array_spé.length; spec++)
            {
                // Si un caractère du nouveau mot de passe est un caractère spécial
                if(nouveau_mdp.value[char] === array_spé[spec])
                {
                    // Le texte du critère spec passe en fond vert
                    txt_spec.style.backgroundColor = valide;

                    // On valide le bool spécial
                    spécialPrésent = true;
                    console.log(`spécialPrésent == ${spécialPrésent}.`);
    
                    // On quitte la boucle
                    break;
                }

                // Si aucun caractère n'est un chiffre
                else
                {
                    // Le texte du critère spécial passe en fond rouge
                    txt_spec.style.backgroundColor = invalide;
                }
            }
        }
    }
} 

// Fonction pour tester toutes les conditions du nouveau mdp
function ConditionsNouveauMDP()
{
    LongueurNouveauMDP();
    Majuscule();
    Minuscule();
    Chiffre();
    Spécial();

    // Si le mot de passe contient au moins 12 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial
    if(nouveau_mdp.value.length > 11 && majusculePrésente && minusculePrésente && chiffrePrésent && spécialPrésent)
    {
        // Alors le mdp est valide
        nouveauMDPValide = true;
        console.log(`nouveauMDPValide == ${nouveauMDPValide}.`);
    }
}

// Fonction pour vérifier que les mot de passes sont identiques
function ComparaisonMDPs()
{
    // Si les mots de passe sont différents
    if(nouveau_mdp.value !== nouveau_mdp_rép.value)
    {
        // On invalide le bool des mdps
        mdpsIdentiques = false;
        console.log(`mdpsIdentiques == ${mdpsIdentiques}.`);

        // L'indiquer en rouge
        txt_compar_mdp.innerText = "Les mots de passe sont différents";
        txt_compar_mdp.style.backgroundColor = invalide;
    }

    // Si les mots de passe sont identiques
    else if(nouveau_mdp.value === nouveau_mdp_rép.value)
    {
        // On valide le bool des mdps
        mdpsIdentiques = true;
        console.log(`mdpsIdentiques == ${mdpsIdentiques}.`);

        // L'indiquer en vert
        txt_compar_mdp.innerText = "Les mots de passe sont identiques";
        txt_compar_mdp.style.backgroundColor = valide;
    }
}

// Fonction pour activer ou désactiver le bouton de validation selon tous les critères (conditions du nouveau mdp, mdps identiques)
function TestToutesConditions()
{
    ComparaisonMDPs();

    // Si tous les critères sont corrects
    if(nomValide && mdpActuelValide && nouveauMDPValide && mdpsIdentiques)
    {
        console.log("Tous les critères sont remplis.");
        btn_nouveau_mdp.disabled = false;
    }
}