<?php
require_once "config/db.php";
global $bdd;
?>

<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<?php

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['sexe']) && isset($_POST['date_naissance'])) {
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$sexe = $_POST['sexe'];
$date_naissance = $_POST['date_naissance'];

$sql = "INSERT INTO clients (nom, prenom, sexe, date_naissance) VALUES (:nom, :prenom, :sexe, :date_naissance)";
$insert = $bdd->prepare($sql);
$verif = $insert->execute([
    'nom' => $nom,
    'prenom' => $prenom,
    'sexe' => $sexe,
    'date_naissance' => $date_naissance,

]);

}
?>
<body>
<h1>
    Bienvenue sur la page de gestions des factures
</h1>
<h2>
    Insertion d'un nouveau client
</h2>
<button><a href="index.php">Accueil</a></button><br><br>
<button class ="clients"><a href="list_clients.php">Accéder à la liste des clients</a></button><br><br>
<form method="post" action="add_client.php">
    <label for="nom">Nom</label>
    <input type="text" name="nom" placeholder="Nom du client"><br>
    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" placeholder="Prénom du client"><br>
    <label for="homme">Homme</label>
    <input type="radio" name="sexe" value="H" id="homme">
    <label for="femme">Femme</label>
    <input type="radio" name="sexe" value="F"> <br>
    <label for="date_naissance">Date de naissance</label>
    <input type="date" name="date_naissance"><br>
    <button type="submit" name="envoyer">Créer client</button>
</form>
</body>
</html>