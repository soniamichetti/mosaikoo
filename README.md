Les deux dossiers qui permettent d'utiliser la base de données sont : 
config.php ligne 5
function.php ligne 10

login : admin1
mdp : admin123


Mettre son mail sur la page Rappel.php

ligne 24 : mail
ligne 25 : mot de passe du mail scripté par Google

ligne 24 : Insérer votre mail qui servira à envoyer le rappel.

Aller dans les réglages Google de son mail.
Dans l'onglet Sécurité activer la "Validation en deux étapes" si ce n'est pas fait.
Cliquer sur le bouton activer "la validation en deux étapes"
Dans la barre de recherche, taper " Mots de passe des applications ".
Pour créer un mot de passe spécifique à une appli indiquer un nom.
Ex : PHPMailer, puis appuyer sur le bouton créer. Le mot de passe est généré.
Garder le précieusement il ne s'affiche qu'une fois !

Quand le mot de passe est bien copié ajouter-le, à la ligne 25 pour mettre le mot de passe.

Ligne 30 : (L'envoyeur) Mettre votre mail, votre nom et prénom
Ligne 31 : (Le receveur) Mettre le mail, nom et prénom de la personne qui reçoit le mail.

Pour pourvoir envoyer le mail il faut composer pour PHPMailer :

installer le composer https://getcomposer.org/download/
Et suivre les étapes via le site

Ensuite sur PowerShell:
Se placer dans le dossier Mosaikoo Rework V2 (au même endroit que les fichiers php/dossier tels qu'image et css)
écrire la commande : composer require phpmailer/phpmailer


Envoyer un mail automatiquement via le planificateur de tâche (Windows) :

Ouvrir le planificateur de tâche
Créer une tâche
Donnez un nom à la tâche Ex: envoi mail
Sélectionner "Exécuter même si l'utilisateur n'est pas connecté".

Dans l'onglet Déclencheur 
Appuyez sur Nouveau
Lancer la tâche : " A l'heure programmée"
dans les paramètres : chaque jour
choisir l'heure : 6:00:00
Cliquer sur ok

Dans l'onglet Action
Appuyez sur Nouveau
Action : Démarrer un programme
dans les paramètres : 
Programme/script parcourir le chemin d'accès jusqu'à php.exe
exemple : C:\laragon\bin\php\php-8.1.10-Win32-vs16-x64\php.exe
Ajouter des arguments parcourir le chemin d'accès jusqu'au fichier php de l'envoi du mail 
ATTENTION les guillemets sont importants "" (ajoutez les)
exemple "C:\laragon\www\codeDepart\Mosaikoo Rework v2\rappel.php"

Dans l'onglet Conditions 
Enlever toutes les conditions activées

Dans l'onglet Paramètres 
Décocher " Arrêter la tache si elle s'exécute plus de :"
Décocher " Si la tâche en cours ne se termine pas sur demande forcer son arrêt"
