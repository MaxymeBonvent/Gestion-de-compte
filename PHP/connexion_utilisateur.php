<?php
    // Fonction pour crypter un mot de passe
    function Encryption($pwd)
    {
        // Si le mdp n'est pas une chaîne de caractères
        if(!is_string($pwd))
        {
            // Afficher un message d'erreur
            echo "<p style='text-align: left; font-size: 20px;'>Erreur : ".$pwd." n'est pas une chaîne de caractères.<p>\n";

            // Fin du script
            return;
        }

        // Clé de cryptage (key => value | caractère => cryptage)
        $encryptionKey = 
        [
            "a" => "qS8!",
            "b" => "Pl9a",
            "c" => "0Ma!",
            "d" => "(7aT",
            "e" => "#Z6u",
            "f" => "oF1+",
            "g" => "_B1g",
            "h" => "s@8M",
            "i" => "-7wY",
            "j" => "9tM}",
            "k" => "a$1L",
            "l" => "3u^N",
            "m" => "t5%V",
            "n" => "+Yr6",
            "o" => "z2[U",
            "p" => "8Ht;",
            "q" => "w$9M",
            "r" => "D6%b",
            "s" => "0?Pv",
            "t" => "a_M3",
            "u" => "qW6_",
            "v" => "*aL4",
            "w" => "P?3c",
            "x" => "@eT7",
            "y" => ":6kH",
            "z" => "]D1x",

            "A" => "Bn/0",
            "B" => "cD_9",
            "C" => "1xY?",
            "D" => "m_6D",
            "E" => "m:0H",
            "F" => "~y6P",
            "G" => "*bV4",
            "I" => "6{Sh",
            "J" => "e_4K",
            "K" => "b8M=",
            "L" => "7l,N",
            "M" => "2O)i",
            "N" => "'L3c",
            "O" => "x_1D",
            "P" => "qM-9",
            "Q" => "5eZ)",
            "R" => "h*7J",
            "S" => "/aC1",
            "T" => "b?6I",
            "U" => "R4@e",
            "V" => "+Nv2",
            "W" => "(4dT",
            "X" => "uJ3%",
            "Y" => "#Y0b",
            "Z" => "8Hi!",

            "0" => "t5_D",
            "1" => "v6G%",
            "2" => "4E@s",
            "3" => "_Ug3",
            "4" => "q/2B",
            "5" => "I6[f",
            "6" => "G@9h",
            "7" => "0Z?e",
            "8" => "r2X]",
            "9" => "Fv7+",

            "~" => "aG7*",
            "#" => "+K6b",
            "'" => "qD2@",
            "{" => "_b6L",
            "}" => "A7t-",
            "(" => "9H*o",
            ")" => "zJ2=",
            "[" => "0P@e",
            "]" => "%g2C",
            "|" => "kD1_",
            "`" => "6E+i",
            "_" => "8Rt}",
            "/" => "bN?1",
            "\\" => "G5)e",
            "\"" => "|U6z",
            "\$" => "aE6@",
            "^" => "G_1m",
            "@" => "Lb]3",
            "=" => "7Mo[",
            "-" => "^z4O",
            "*" => "Dh#6",
            "." => "-U4d",
            "+" => "_R9p",
            "%" => "kI3}",
            "!" => "5Di$",
            "?" => "|4Tf",
            "," => "U@)6",
            ":" => "8Es*",
        ];

        // mdp crypté
        $crypted_pwd = "";

        // Pour chaque caractère du mdp
        for($c = 0; $c < strlen($pwd); $c++)
        {
            // On assigne une variable au caractère capturé quand on place le curseur devant le caractère $c du mdp et que le curseur se déplace de 1 caractère
            $currentChar = substr($pwd, $c, 1);

            // Si le caractère existe dans la clé de cryptage
            if(array_key_exists($currentChar, $encryptionKey))
            {
                // On ajoute le cryptage correspondant au mdp crypté
                $crypted_pwd .= $encryptionKey[$currentChar];
            }

            // Si le caractère n'existe pas dans la clé de cryptage
            else
            {
                // On affiche un message d'erreur
                echo "<p style='text-align: left; font-size: 20px;'>Erreur : " .$currentChar. " n'a pas d'équivalent dans la clé de cryptage.</p>\n";

                // On met fin à la fonction
                return;
            }
        }

        // Retour du mdp crypté pour une utilisation dans d'autres fonctions
        return $crypted_pwd;
    }

    // --- VARIABLES DU FORMULAIRE --- //
    $username = $_POST["username"];
    $mdp = $_POST["mdp"];

    // --- ERREURS NOM --- //

    // Si le nom est inexistant
    if(empty($username))
    {
        // Le dire à l'utilisateur
        echo "<p>Erreur : aucun nom donné.</p>";

        // Fin du script
        exit;
    }

    // Si le nom est trop long
    if(strlen($username) > 20)
    {
        // Le dire à l'utilisateur
        echo "<p>Erreur : le nom est de taille supérieur à 20 caractères.</p>";

        // Fin du script
        exit;
    }

    // --- ERREURS MOT DE PASSE --- //

    // Si le mdp est inexistant
    if(empty($mdp))
    {
        // Le dire à l'utilisateur
        echo "<p>Erreur : aucun mot de passe donné.</p>";

        // Fin du script
        exit;
    }

    // Si le mdp est trop long
    if(strlen($mdp) > 80)
    {
        // Le dire à l'utilisateur
        echo "<p>Erreur : le mot de passe est de taille supérieur à 80 caractères.</p>";

        // Fin du script
        exit;
    }

    // --- FORMULAIRE VALIDE --- //
    if(!empty($username) && strlen($username) < 21 && !empty($mdp) && strlen($mdp) < 81)
    {
        // On place la forme crypté du mdp du formulaire dans une variable
        $mdp_form_crypt = Encryption($mdp);

        // Connexion à la DB
        include_once("connexion_db.php");
        
        // Requête pour sélectionner le mdp crypté de la DB qui correspond au nom du formulaire
        $mdp_nom = "SELECT username, crypt_pwd FROM utilisateurs WHERE username = $1";

        // Préparation
        $prepa_mdp_nom = pg_prepare($db, "mdp_nom", $mdp_nom);

        // Exécution
        $exec_mdp_nom = pg_execute($db, "mdp_nom", array($username));

        // Si l'exécution renvoi au moins une rangée
        if($rangée_mdp_nom = pg_fetch_assoc($exec_mdp_nom))
        {
            // Si la rangée n'existe pas
            if(!$rangée_mdp_nom)
            {
                // Message d'erreur
                echo "<p style='text-align: center; font-size: 20px;'>Erreur: aucune rangée de la base de donnée ne contient ce nom et ce mot de passe ensemble.</p>";

                // Fin du script
                exit;
            }

            // TEST FORMULAIRE
            echo "<p style='text-align: left; font-size: 20px;'>Nom du formulaire : " . $username . "</p>";
            echo "<p style='text-align: left; font-size: 20px;'>Mot de passe du formulaire : " . $mdp . "</p>";
            echo "<p style='text-align: left; font-size: 20px;'>Mot de passe du formulaire crypté : " . $mdp_form_crypt . "</p>";

            // TEST DB
            echo "<p style='text-align: left; font-size: 20px;'>Nom de la DB : " . $rangée_mdp_nom["username"] . "</p>";
            echo "<p style='text-align: left; font-size: 20px;'>Mot de passe de la DB : " . $rangée_mdp_nom["crypt_pwd"] . "</p>";
           
            // Si le cryptage du mdp du formulaire correspond au mdp crypté de la DB 
            if($mdp_form_crypt === $rangée_mdp_nom["crypt_pwd"])
            {
                // Message de réussite de la connexion
                echo "<p style='text-align: center; font-size: 20px;'>Réussite de la connexion.</p>";

                // Fin du script
                exit;
            }

            // Si la connexion échoue
            else if($mdp_form_crypt !== $rangée_mdp_nom["crypt_pwd"])
            {
                // Message d'échec de la connexion
                echo "<p style='text-align: center; font-size: 20px;'>Échec de la connexion, le mot de passe du formulaire et celui de la DB ne correspondent pas.</p>";

                // Fin du script
                exit;
            }
        }
    }
?>