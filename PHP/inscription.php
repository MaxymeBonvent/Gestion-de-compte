<?php
    // Fonction pour crypter un mot de passe
    function Encryption($pwd)
    {
        // Si le mdp n'est pas une chaîne de caractères
        if(!is_string($pwd))
        {
            // Afficher un message d'erreur
            echo "Erreur : ".$pwd." n'est pas une chaîne de caractères.\n";

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
            // On assigne une variable au caractère capturé quand on place le curseur au caractère $c du mdp et que le curseur se déplace de 1 caractère
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
                echo "Erreur : " .$currentChar. " n'a pas d'équivalent dans la clé de cryptage.\n";

                // On met fin à la fonction
                return;
            }
        }

        // Retour du mdp crypté pour une utilisation dans d'autres fonctions
        return $crypted_pwd;
    }

    // --- VARIABLES DU FORMULAIRE --- //

    // Variable du nouveau compte
    $username = $_POST["username"];
    $mail = $_POST["mail"];
    $mdp = $_POST["mdp"];
    $répé_mdp = $_POST["répé_mdp"];

    // --- ERREURS NOM --- //

    // Si le nom n'existe pas
    if(empty($username))
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : vous n'avez pas de nom.</p>";

        // Fin du script
        exit;
    }

    // Si le nom est trop long
    if(strlen($username) > 20)
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : votre nom fait plus de 20 caractères.</p>";

        // Fin du script
        exit;
    }

    // --- ERREURS MAIL --- //

    // Si le mail n'existe pas
    if(empty($mail))
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : vous n'avez pas de mail.</p>";

        // Fin du script
        exit;
    }

    // Si le mail est trop long
    if(strlen($mail) > 80)
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : votre mail fait plus de 80 caractères.</p>";

        // Fin du script
        exit;
    }

    // --- ERREURS MOT DE PASSE --- //

    // Si le mot de passe n'existe pas
    if(empty($mdp))
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : vous n'avez pas de mot de passe.</p>";

        // Fin du script
        exit;
    }

    // Si le mdp est trop court
    if(strlen($mdp) < 12)
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : votre mot de passe fait moins de 12 caractères.</p>";

        // Fin du script
        exit;
    }

    // --- ERREURS MOT DE PASSE RÉPÉTÉ --- //

    // Si le mot de passe répété n'existe pas
    if(empty($répé_mdp))
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : vous n'avez pas de mot de passe répété.</p>";

        // Fin du script
        exit;
    }

    // Si le mdp répété est trop court
    if(strlen($répé_mdp) < 12)
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : votre mot de passe répété fait moins de 12 caractères.</p>";

        // Fin du script
        exit;
    }

    // Si les mots de passe sont différents
    if($mdp !== $répé_mdp)
    {
        // On le dit à l'utilisateur
        echo "<p>Erreur : vos mots de passe sont différents.</p>";

        // Fin du script
        exit;
    }

    // Si toutes les conditions sont remplis
    if(!empty($username) && strlen($username) < 21 && !empty($mail) && strlen($mail) < 81 && !empty($mdp) && strlen($mdp) > 11 && strlen($mdp) < 100 && !empty($répé_mdp) && strlen($répé_mdp) > 11 && strlen($répé_mdp) < 100 && $mdp === $répé_mdp)
    {
        // On essai d'enregistrer un nouveau compte
        try
        {
            // Connexion à la DB
            include_once("connexion_db.php");

            // Début de la transaction
            pg_query($db, "BEGIN");

            // Cryptage du mot de passe
            $mdp_crypt = Encryption($mdp);

            // Requête d'insertion du compte dans la DB
            $insertion_compte = "INSERT INTO utilisateurs (username, mail, crypt_pwd) VALUES ($1, $2, $3)";

            // Préparation
            $prepa_insertion_compte = pg_prepare($db, "insertion_compte", $insertion_compte);

            // Exécution
            $exec_insertion_compte = pg_execute($db, "insertion_compte", array($username, $mail, $mdp_crypt));

            // Si l'insertion échoue
            if(!$exec_insertion_compte) 
            {
                // Afficher un message d'erreur
                echo "<p>Erreur pendant l'enregistrement de votre compte: " . pg_last_error($db).". Opération annulée.</p>";

                // Annulation de la transaction
                pg_query($db, "ROLLBACK");

                // Fin du script
                exit;
            }

            // Lancement de la transaction
            pg_query($db, "COMMIT");

            // Début de la session
            session_start();

            // Création des variables de session
            $_SESSION["username"] = $username;
            $_SESSION["mail"] = $mail;

            // Redirection vers la page de profil
            header("Location: profile.php");
        }
     
        // Si l'enregistrement d'un nouveau compte échoue
        catch(Exception $exc)
        {
            // Annulation de la transaction
            pg_query($db, "ROLLBACK");

            // Affichage de toutes les erreurs
            error_reporting(E_ALL);

            // Affichage d'un message d'erreur à l'utilisateur
            echo "<p>Exception apparu pendant la création de votre compte : " . $exc . ". Opération annulée.</p>";

            // Fin du script
            exit;
        }
    }
?>