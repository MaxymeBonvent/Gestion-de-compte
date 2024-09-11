<?php
    // Affichage de toutes les erreurs
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    // Encodage
    header('Content-Type: text/html; charset=utf-8');

    // Connexion à la DB
    include_once("connexion_db.php");

    // DÉBUT DE PAGE
    echo "<!DOCTYPE html><html lang='fr'><body style='background-color: black;'>";

    // Début d'affichage
    echo "<pre style='color : rgb(180, 180, 180); text-align: center; font-size: 20px;'>";

    // --- MISE EN PLACE DE PHPMAILER --- //

    // Espaces de noms
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    // Fichiers
    require "PHPMailer/src/Exception.php";
    require "PHPMailer/src/PHPMailer.php";
    require "PHPMailer/src/SMTP.php";

    // Fonction
    function sendMail($auteur, $mail_auteur, $sujet, $message, $destinaire)
    {
        // Mise en place des paramètres
        $mail = new PHPMailer(true);

        try
        {
            // Paramètres SMTP
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS = Transport Layer Security
            $mail->Port = 587;

            // Nom et MDP de l'admin, qui s'envoit un mail à lui-même
            $mail->Username = $auteur;
            $mail->Password = "Sp@ceJourne8";

            // Adresse et nom de l'auteur du mail, adresse du destinaire
            $mail->setFrom($mail_auteur, $auteur);
            $mail->addAddress($destinaire);

            // Sujet et texte du mail
            $mail->Subject = $sujet;
            $mail->Body = $message;
            $mail->AltBody = strip_tags($message);

            // Si l'envoi du mail échoue
            if(!$mail->send())
            {
                // Affichage d'un message d'erreur
                echo "Échec de l'envoi du mail.";

                // Fin du script
                exit;
            }

            // Si l'envoi du mail réussi
            else
            {
            // Affichage d'un message de réussite
            echo "Réussite de l'envoi du mail.";

            // Fin du script
            exit;  
            }
        }

        catch(Exception $exc)
        {
            // Message d'erreur
            echo "Erreur lors de l'envoi du mail : " . $exc->getMessage();
        }
        
    }

        // --- ERREURS FORMULAIRE --- //

        // Si la méthode n'est pas POST
        if($_SERVER["REQUEST_METHOD"] !== "POST")
        {
            // Afficher un message d'erreur
            echo "Erreur : la méthode utilisé n'est pas POST";

            // Fin du script
            exit;
        }

        // Variables du compte qui demande un nouveau mdp
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);

        // --- ERREURS NOM  --- //

        // S'il n'y a pas de nom
        if(empty($username))
        {
            // Afficher un message d'erreur
            echo "Erreur : aucun nom.";

            // Fin du script
            exit;
        }

        // Si le nom est trop long
        if(strlen($username) > 20)
        {
            // Afficher un message d'erreur
            echo "Erreur : le nom > 20 caractères";

            // Fin du script
            exit;
        }

        // --- ERREURS MAIL  --- //

        // S'il n'y a pas de mail
        if(empty($email))
        {
            // Afficher un message d'erreur
            echo "Erreur : aucun mail.";

            // Fin du script
            exit;
        }

        // Si le format du mail n'est pas valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            // Afficher un message d'erreur
            echo "Erreur : le format du mail n'est pas valide.";

            // Fin du script
            exit;
        }

        // Si le mail est trop long
        if(strlen($email) > 100)
        {
            // Afficher un message d'erreur
            echo "Erreur : le mail > 100 caractères";

            // Fin du script
            exit;
        }

        // --- FORMULAIRE VALIDE --- //
        else
        {
            // --- ON VÉRIFIE QUE L'UTILISATEUR EXISTE --- //

            // Requête
            $nom_mail = "SELECT username, mail FROM utilisateurs WHERE username = $1 AND mail = $2";

            // Préparation
            $prepa_nom_mail = pg_prepare($db, "nom_mail", $nom_mail);

            // Exécution
            $exec_nom_mail = pg_execute($db, "nom_mail", array($username, $email));

            // Si l'exécution échoue
            if(!$exec_nom_mail)
            {
                // Afficher un message d'erreur
                echo "Échec de l'exécution de la requête d'obtention du nom et du mail de l'utilisateur qui a oublié son MDP.";

                // Fin du script
                exit;
            }

            // Si l'exécution réussi
            else
            {
                // On stock les données dans un array
                $array_nom_mail = pg_fetch_assoc($exec_nom_mail);

                // Si l'array nom-mail est vide
                if(!$array_nom_mail)
                {
                    // Message d'inexistence
                    echo "Erreur : l'utilisateur n'existe pas."; 

                    // Fin du script
                    exit; 
                }
                
                // Si l'array nom-mail n'est pas vide
                else
                {
                    // On isole le nom de la DB trimé
                    $nom_db = trim($array_nom_mail["username"]);

                    // On isole le mail de la DB trimé
                    $mail_db = trim($array_nom_mail["mail"]);

                    // Si le nom et le mail du formulaire correspondent à ceux de la DB
                    if($username === $nom_db && $email === $mail_db)
                    {
                        // Message d'existence
                        echo "L'utilisateur existe.\n";

                        // --- VARIABLES ENVOYEUR ET RECEVEUR DE MAIL --- //
                        $auteur = "Teal Comet";
                        $mail_auteur = "teal.comett@gmail.com";
                        $sujet = "Oubli MDP";
                        $message = "L'utilisateur $nom_db - $mail_db a oublié son MDP.";
                        $destinataire = "teal.comett@gmail.com";

                        // Tentative d'envoi du mail
                        try
                        {
                            sendMail($auteur, $mail_auteur, $sujet, $message, $destinataire);

                            // Fin du script
                            exit; 
                        }

                        // Si l'envoi du mail échoue
                        catch(Exception $exc)
                        {
                            // Afficher un message d'erreur
                            echo "Erreur lors de l'envoi du mail : " . $exc->getMessage();

                            // Fin du script
                            exit; 
                        }
                    }

                    // Si le nom et le mail du formulaire ne correspondent pas à ceux de la DB
                    else
                    {
                        // Message d'inexistence
                        echo "Erreur : l'utilisateur n'existe pas."; 

                        // Fin du script
                        exit; 
                    }
                }
            }
        }
    
    // Fin d'affichage
    echo "</pre>";

    // FIN DE PAGE
    echo "</body></html>";
?>