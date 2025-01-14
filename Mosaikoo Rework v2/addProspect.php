<?php
session_start();
require_once "config.php";

$pdo = connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_etat = 2; // Valeur par défaut de l'état (en cours)
    $nom = $_POST['NOM'];
    $email = $_POST['EMAIL'];
    $prenom = $_POST['PRENOM'];
    $ville = $_POST['VILLE'];
    $web_mobile = $_POST['WEB_MOBILE'];
    $systeme_exploitation = $_POST['SYSTEME_EXPLOITATION'];
    $adresse_ip = $_POST['ADRESSE_IP'];
    $maps = $_POST['MAPS'];
    $image_entree = $_POST['IMAGE_ENTREE'];
    $numero_telephone = $_POST['numero_telephone'];
    $navigateur = $_POST['Navigateur'];
    $date_prospect = $_POST['Date_prospect'];
    $date_creation = date("Y/m/d"); // Date actuelle

    $sql_check_email = "SELECT COUNT(*) FROM prospect WHERE EMAIL = :EMAIL";
    $stmt_check_email = $pdo->prepare($sql_check_email);
    $stmt_check_email->execute([':EMAIL' => $email]);
    $email_exists = $stmt_check_email->fetchColumn();

    if ($email_exists) {
        // Si l'email existe déjà, afficher un message d'erreur
        $error_message = "L'adresse email est déjà utilisée";
    } else {
        // Ne pas inclure ID_PROSPECT dans la requête INSERT, car il est auto-incrémenté
        $sql = "INSERT INTO prospect (ID_ETAT, NOM, EMAIL, PRENOM, VILLE, WEB_MOBILE, SYSTEME_EXPLOITATION, ADRESSE_IP, MAPS, IMAGE_ENTREE, NUMERO_TELEPHONE, NAVIGATEUR, DATE_PROSPECT,date_creation)
            VALUES (:ID_ETAT, :NOM, :EMAIL, :PRENOM, :VILLE, :WEB_MOBILE, :SYSTEME_EXPLOITATION, :ADRESSE_IP, :MAPS, :IMAGE_ENTREE, :NUMERO_TELEPHONE, :NAVIGATEUR, :DATE_PROSPECT, :date_creation)";

        // Préparation de la requête
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':ID_ETAT' => $id_etat,
            ':NOM' => $nom,
            ':EMAIL' => $email,
            ':PRENOM' => $prenom,
            ':VILLE' => $ville,
            ':WEB_MOBILE' => $web_mobile,
            ':SYSTEME_EXPLOITATION' => $systeme_exploitation,
            ':ADRESSE_IP' => $adresse_ip,
            ':MAPS' => $maps,
            ':IMAGE_ENTREE' => $image_entree,
            ':NUMERO_TELEPHONE' => $numero_telephone,
            ':NAVIGATEUR' => $navigateur,
            ':DATE_PROSPECT' => $date_prospect,
            ':date_creation' => $date_creation,

        ]);
        header("Location: prospect.php");
        exit(); // N'oubliez pas de terminer le script pour éviter d'exécuter du code supplémentaire
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Ajouter un prospect</title>
</head>

<body>

    <?php
    // Afficher le message d'erreur si l'email existe déjà
    if (isset($error_message)) {
        echo "<p style='color: red; font-weight:bold; font-family:arial'>" . $error_message . "</p>";
    }
    ?>
    <div class="container">
        <div class="row center mt-5">
            <div class="col-md-6 mx-auto">
                <form method="post" class="p-4 rounded shadow">
                    <h3 class="text-center mb-4">Ajouter un Prospect</h3>
                    <div class="form-group">
                        <label for="NOM">Nom :</label>
                        <input type="text" name="NOM" id="NOM" class="form-control" placeholder="Nom" required>
                    </div>
                    <div class="form-group">
                        <label for="EMAIL">Email :</label>
                        <input type="email" name="EMAIL" id="EMAIL" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="PRENOM">Prénom :</label>
                        <input type="text" name="PRENOM" id="PRENOM" class="form-control" placeholder="Prénom">
                    </div>
                    <div class="form-group">
                        <label for="VILLE">Ville :</label>
                        <input type="text" name="VILLE" id="VILLE" class="form-control" placeholder="Ville">
                    </div>
                    <div class="form-group">
                        <label for="WEB_MOBILE">Web mobile :</label>
                        <input type="text" name="WEB_MOBILE" id="WEB_MOBILE" class="form-control" placeholder="Web Mobile">
                    </div>
                    <div class="form-group">
                        <label for="SYSTEME_EXPLOITATION">Système d'exploitation :</label>
                        <input type="text" name="SYSTEME_EXPLOITATION" id="SYSTEME_EXPLOITATION" class="form-control" placeholder="Système d'exploitation">
                    </div>
                    <div class="form-group">
                        <label for="ADRESSE_IP">Adresse IP :</label>
                        <input type="text" name="ADRESSE_IP" id="ADRESSE_IP" class="form-control" placeholder="Adresse IP">
                    </div>
                    <div class="form-group">
                        <label for="MAPS">Maps :</label>
                        <input type="text" name="MAPS" id="MAPS" class="form-control" placeholder="Maps">
                    </div>
                    <div class="form-group">
                        <label for="IMAGE_ENTREE">Image :</label>
                        <input type="text" name="IMAGE_ENTREE" id="IMAGE_ENTREE" class="form-control" placeholder="Image d'entrée">
                    </div>
                    <div class="form-group">
                        <label for="numero_telephone">Téléphone :</label>
                        <input type="tel" name="numero_telephone" id="numero_telephone" class="form-control" placeholder="Numéro Téléphone" required>
                    </div>
                    <div class="form-group">
                        <label for="Navigateur">Navigateur :</label>
                        <input type="text" name="Navigateur" id="Navigateur" class="form-control" placeholder="Navigateur">
                    </div>
                    <div class="form-group">
                        <label for="Date_prospect">Date rendu :</label>
                        <input type="date" name="Date_prospect" id="Date_prospect" class="form-control" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Ajouter le prospect</button>
                    </div>
                    <div class="text-center mt-3">
                        <a class="btn btn-outline-info" href="prospect.php">Revenir à la liste</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>