// FONDS
let invalide = "rgb(180, 0, 0)";
let valide = "rgb(0, 160, 0)";

// VARIABLES DU NOM
let input_nom = document.getElementById("nom");
let longueur_nom = document.getElementById("longueur_nom");
let nomValide = false;

// VARIABLES DU MAIL
let input_mail = document.getElementById("mail");
let longueur_mail = document.getElementById("longueur_mail");
let mailValide = false;

// VARIABLES DU MOT DE PASSE
let mdp = document.getElementById("mdp");

// VARIABLES DU MOT DE PASSE RÉPÉTÉ
let répé_mdp = document.getElementById("répé_mdp");

// CONDITIONS DU MOT DE PASSE
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
let mdpValide = false;

// VARIABLE DE COMPARAISON DES MOTS DE PASSE
let txt_compar_mdp = document.getElementById("txt_compar_mdp");
let mdpsIdentiques = false;

// BOUTON DE VALIDATION
let btn_validation = document.getElementById("btn_nouveau_compte");
btn_validation.disabled = true;



// --- FONCTIONS --- //



// Fonction pour afficher la longueur du nom
function LongueurNom()
{
    // Affichage de la longueur du nom
    longueur_nom.innerText = input_nom.value.length; 
    
    // Si le nom fait plus de 20 caractères
    if(input_nom.value.length > 20)
    {
        // On invalide le bool du nom
        nomValide = false;
        console.log(`nomValide == ${nomValide}.`);

        // Afficher le texte en rouge
        longueur_nom.style.backgroundColor = invalide;
    }

    // Si le nom fait entre 1 et 20 caractères
    else if(input_nom.value.length > 0 && input_nom.value.length < 21)
    {
        // On valide le bool du nom
        nomValide = true;
        console.log(`nomValide == ${nomValide}.`);

        // Afficher le texte en vert
        longueur_nom.style.backgroundColor = valide;
    }

    // Si le nom fait moins de 1 caractères, afficher le texte sans fond
    else if(input_nom.value.length < 1)
    {
        // On invalide le bool du nom
        nomValide = false;
        console.log(`nomValide == ${nomValide}.`);

        // Afficher le texte sans fond
        longueur_nom.style.backgroundColor = "transparent";
    }
}

// Fonction pour afficher la longueur du mail
function LongueurMail()
{
    // Affichage de la longueur du mail
    longueur_mail.innerText = input_mail.value.length; 
    
    // Si le mail fait plus de 80 caractères
    if(input_mail.value.length > 80)
    {
        // On invalide le bool du mail
        mailValide = false;
        console.log(`mailValide == ${mailValide}.`);

        // Afficher le texte en rouge
        longueur_mail.style.backgroundColor = invalide;
    }

    // Si le mail fait entre 1 et 80 caractères
    else if(input_mail.value.length > 0 && input_mail.value.length < 81)
    {
        // On valide le bool du mail
        mailValide = true;
        console.log(`mailValide == ${mailValide}.`);
        
        // Afficher le texte en vert
        longueur_mail.style.backgroundColor = valide;
    }

    // Si le mail fait moins de 1 caractères
    else if(input_mail.value.length < 1)
    {
        // On invalide le bool du mail
        mailValide = false;
        console.log(`mailValide == ${mailValide}.`);

        // Afficher le texte sans fond
        longueur_mail.style.backgroundColor = "transparent";
    }
}

// Fonction pour afficher la longueur du mdp
function LongueurMDP()
{  
    // Si le mdp fait plus de 0 et moins de 12 caractères
    if(mdp.value.length > 0 && mdp.value.length < 12)
    {
        // Afficher le texte en rouge
        txt_longueur.style.backgroundColor = invalide;

        console.log("Mot de passe trop court.");
    }

    // Si le mdp fait au moins de 12 caractères
    else if(mdp.value.length > 11)
    {
        // Afficher le texte en vert
        txt_longueur.style.backgroundColor = valide;

        console.log("Mot de passe d'au moins 12 caractères.");
    }

    // Si le mdp fait moins de 1 caractères
    else if(mdp.value.length < 1)
    {
        // Afficher le texte sans fond
        txt_longueur.style.backgroundColor = "transparent";

        console.log("Mot de passe vide.");
    }
}

// Fonction pour vérifier qu'au moins 1 majuscule est présente dans le mot de passe
function Majuscule()
{
    // Si le mot de passe fait moins de 1 caractère
    if(mdp.value.length < 1)
    {
        // Le texte du critère majuscule passe sans fond
        txt_maj.style.backgroundColor = "transparent";
    }

    // Si le mot de passe fait au moins 1 caractère
    else if(mdp.value.length > 0 && !majusculePrésente)
    {
        // Pour chaque caractère du mot de passe
        for(let char = 0; char < mdp.value.length; char++)
        {
            // Pour chaque majuscule
            for(let maj = 0; maj < array_maj.length; maj++)
            {
                // Si un caractère du mot de passe est une majuscule
                if(mdp.value[char] === array_maj[maj])
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

// Fonction pour vérifier qu'au moins 1 minuscule est présente dans le mot de passe
function Minuscule()
{
    // Si le mot de passe fait moins de 1 caractère
    if(mdp.value.length < 1)
    {
        // Le texte du critère minuscule passe sans fond
        txt_min.style.backgroundColor = "transparent";
    }

    // Si le mot de passe fait au moins 1 caractère
    else if(mdp.value.length > 0 && !minusculePrésente)
    {
        // Pour chaque caractère du mot de passe
        for(let char = 0; char < mdp.value.length; char++)
        {
            // Pour chaque minuscule
            for(let min = 0; min < array_min.length; min++)
            {
                // Si un caractère du mot de passe est une minuscule
                if(mdp.value[char] === array_min[min])
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

// Fonction pour vérifier qu'au moins 1 chiffre est présent dans le mot de passe
function Chiffre()
{
    // Si le mot de passe fait moins de 1 caractère
    if(mdp.value.length < 1)
    {
        // Le texte du critère chiffre passe sans fond
        txt_chiffre.style.backgroundColor = "transparent";
    }

    // Si le mot de passe fait au moins 1 caractère et qu'aucun chiffre n'est encore présent
    else if(mdp.value.length > 0 && !chiffrePrésent)
    {
        // Pour chaque caractère du mot de passe
        for(let char = 0; char < mdp.value.length; char++)
        {
            // Pour chaque chiffre
            for(let chiffre = 0; chiffre < array_chiffre.length; chiffre++)
            {
                // Si un caractère du mot de passe est un chiffre
                if(mdp.value[char] === array_chiffre[chiffre])
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

// Fonction pour vérifier qu'au moins 1 caractère spécial est présent dans le mot de passe
function Spécial()
{
    // Si le mot de passe fait moins de 1 caractère
    if(mdp.value.length < 1)
    {
        // Le texte du critère spécial passe sans fond
        txt_spec.style.backgroundColor = "transparent";
    }

    // Si le mot de passe fait au moins 1 caractère et qu'aucun caractère spécial n'est encore présent
    else if(mdp.value.length > 0 && !spécialPrésent)
    {
        // Pour chaque caractère du mot de passe
        for(let char = 0; char < mdp.value.length; char++)
        {
            // Pour chaque caractère spécial
            for(let spec = 0; spec < array_spé.length; spec++)
            {
                // Si un caractère du mot de passe est un caractère spécial
                if(mdp.value[char] === array_spé[spec])
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

// Fonction pour tester toutes les conditions du mdp
function ConditionsMDP()
{
    LongueurMDP();
    Majuscule();
    Minuscule();
    Chiffre();
    Spécial();

    // Si le mot de passe contient au moins 12 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial
    if(mdp.value.length > 11 && majusculePrésente && minusculePrésente && chiffrePrésent && spécialPrésent)
    {
        // Alors le mdp est valide
        mdpValide = true;
        console.log(`mdpValide == ${mdpValide}.`);
    }
}

// Fonction pour vérifier que les mot de passes sont identiques
function ComparaisonMDPs()
{
    // Si les mots de passe sont différents
    if(mdp.value !== répé_mdp.value)
    {
        // On invalide le bool des mdps
        mdpsIdentiques = false;
        console.log(`mdpsIdentiques == ${mdpsIdentiques}.`);

        // L'indiquer en rouge
        compar_mdp.innerText = "Les mots de passe sont différents";
        compar_mdp.style.backgroundColor = invalide;
    }

    // Si les mots de passe sont identiques
    else if(mdp.value === répé_mdp.value)
    {
        // On valide le bool des mdps
        mdpsIdentiques = true;
        console.log(`mdpsIdentiques == ${mdpsIdentiques}.`);

        // L'indiquer en vert
        compar_mdp.innerText = "Les mots de passe sont identiques";
        compar_mdp.style.backgroundColor = valide;
    }
}

// Fonction pour activer ou désactiver le bouton de validation selon tous les critères (nom, mail, toutes les conditions du mdp, mdps identiques)
function TestToutesConditions()
{
    ComparaisonMDPs();

    // Si tous les critères sont corrects
    if(nomValide && mailValide && mdpValide && mdpsIdentiques)
    {
        console.log("Tous les critères sont remplis.");
        btn_validation.disabled = false;
    }
}