// Variable des nom des utilisateurs
let noms_utilisateurs = document.getElementsByClassName("noms_utilisateurs");

// Variable des checkbox
let checks = document.getElementsByClassName("check");

// Variable du texte du nombre de mdp à modifier
let txt_nb_mdp_admin = document.getElementById("txt_nb_mdp_admin");

// Variable du formulaire réservé à l'admin
let form_mdps_admin = document.getElementById("form_mdps_admin");
form_mdps_admin.style.display = "none";

// Variable des champs ajoutés pour chaque case cochée
let champs_utilisateurs = document.getElementById("champs_utilisateurs");

// Fonction pour compte le nombre de cases cochées
function CompteCasesCochées()
{
    // Nombre de cases cochées
    let nb_checks_cochées = 0;

    // Pour chaque checkbox
    for(let c = 0; c < checks.length; c++)
    {
        // Si une checkbox est cochée
        if(checks[c].checked)
        {
            nb_checks_cochées++;
        }
    }

    // Remplacer le texte par défaut du nombre de cases cochées par le véritable nombre de cases cochées
    txt_nb_mdp_admin.innerText = nb_checks_cochées;

    // Si moins de 1 case est cochée
    if(nb_checks_cochées < 1)
    {
        // Le formulaire réservé à l'admin disparait
        form_mdps_admin.style.display = "none";
    }

    // Si au moins 1 case est cochée
    else
    {
        // Le formulaire réservé à l'admin apparait
        form_mdps_admin.style.display = "flex";
        form_mdps_admin.style.flexDirection = "column";
        form_mdps_admin.style.alignItems = "center";
        form_mdps_admin.style.margin = "10px 0";

        // Les champs nom et nouveau mot de passe sont retirés
        champs_utilisateurs.innerHTML = "";

        // Pour chaque case cochée
        for(let num = 0; num < nb_checks_cochées; num++)
        {
            // Ajouter des champs nom et nouveau mot de passe
            champs_utilisateurs.innerHTML += 
            `   <div>
                    <label for='nom_${noms_utilisateurs[num].textContent.trim()}'>Utilisateur ${num+1}</label>
                    <input name='nom_${noms_utilisateurs[num].textContent.trim()}' id='nom_${noms_utilisateurs[num].textContent.trim()}' type='text' value='${noms_utilisateurs[num].textContent.trim()}' autocomplete='off' required>
                </div>
                
                <div>
                    <label for='mdp_${noms_utilisateurs[num].textContent.trim()}'>Nouveau MDP ${noms_utilisateurs[num].textContent.trim()}</label>
                    <input name='mdp_${noms_utilisateurs[num].textContent.trim()}' id='mdp_${noms_utilisateurs[num].textContent.trim()}' type='password' placeholder='************' autocomplete='off' required>
                </div>`;
        }
    }
}