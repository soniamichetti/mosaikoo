<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure l'autoload de Composer
require 'vendor/autoload.php';

require "function.php"; 
session_start();
require_once "config.php";

$pdo = connect();

// Configuration de PHPMailer
$mail = new PHPMailer(true);

$mail->CharSet = 'UTF-8';

try {
    // Configuration du serveur SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sonia.michetti7@gmail.com'; // Ton adresse Gmail
    $mail->Password = 'ylrr oive jvpa svtu';       // Ton mot de passe Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Destinataires
    $mail->setFrom('sonia.michetti7@gmail.com', 'MICHETTI Sonia'); // Envoyeur ('mail','NOM Prenom')
    $mail->addAddress('sonia.michetti7@gmail.com', 'MICHETTI Sonia'); // Receveur ('mail','NOM Prenom)

    // Requête SQL pour récupérer les prospects "En cours"
    $sql = "SELECT nom,prenom,ville, numero_telephone, id_etat, date_creation FROM prospect WHERE id_etat = 1";
    $stmt = $pdo->query($sql);
    $dateActuelle = new DateTime();

      // Si aucun prospect "En cours", afficher un message
      if ($stmt->rowCount() == 0) {
        $htmlTable = '<p>Aucun prospect en cours.</p>';
    } else {
        // Génération du tableau HTML des prospects "En cours"
        $htmlTable = '<table border="1" cellpadding="5" cellspacing="0">';
        $htmlTable .= '<thead><tr><th>Nom</th><th>Prénom</th><th>Ville</th><th>Téléphone</th><th>État</th><th>Date création</th></tr></thead><tbody>';
        
        
        // Parcourir les prospects récupérés et les afficher
        while ($prospect = $stmt->fetch(PDO::FETCH_OBJ)) {

        $dateCreation = $prospect->date_creation ?? null; // Vérifier si la date de création est disponible
        if ($dateCreation) {
            $dateCreation = new DateTime($dateCreation);
            $interval = $dateCreation->diff($dateActuelle)->format('%a').' jour(s)';
        } else {
            $interval = 'Non spécifiée';
        }
            $htmlTable .= '<tr>';
            $htmlTable .= '<td>' . htmlspecialchars($prospect->nom ?? 'N/A') . '</td>';
            $htmlTable .= '<td>' . htmlspecialchars($prospect->prenom ?? 'N/A') . '</td>';
            $htmlTable .= '<td>' . htmlspecialchars($prospect->ville ?? 'N/A') . '</td>';
            $htmlTable .= '<td>' . htmlspecialchars($prospect->numero_telephone ?? 'N/A') . '</td>';
            $htmlTable .= '<td><span style="color: orange;">En cours</span></td>';
            $htmlTable .= '<td>' . htmlspecialchars($interval) . '</td>'; // Ajouter la durée au tableau
            $htmlTable .= '</tr>';
        }
        $htmlTable .= '</tbody></table>';
    }
    

    // Contenu de l'e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Prospects à appeler';
    $mail->Body = '<h1>Voici les prospects à appeler :</h1>' . $htmlTable;
    $mail->AltBody = "Voici les prospects à appeler :\n" . 
        implode("\n", array_map(function ($prospect) {
            return "{$prospect['nom']} - {$prospect['prenom']} - {$prospect['ville']} - {$prospect['telephone']} - {$interval} - En cours";
        }, $stmt->fetchAll(PDO::FETCH_ASSOC)));

    // Envoyer l'e-mail
    $mail->send();
    echo 'E-mail envoyé avec succès !';
    } catch (Exception $e) {
    echo "L'e-mail n'a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
    }