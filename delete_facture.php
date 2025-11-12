<?php
require_once "config/db.php";
global $bdd;


require_once "config/db.php";
global $bdd;

if (isset($_GET['id_facture'])) {
    $id_facture = $_GET['id_facture'];
    $sql = "DELETE FROM factures WHERE id_facture = :id_facture";
    $delete = $bdd->prepare($sql);
    $facture_a_supprimer = $delete->execute([
            'id_facture' => $id_facture
            ]);
}

$sql = "SELECT * FROM clients";
$query = $bdd->query($sql);
$clients = $query->fetchAll();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<h1>
    Bienvenue sur la page de gestions des factures
</h1>
<h2>
    Suppression d'une facture
</h2>
<button><a href="index.php">Accueil</a></button><br><br>
<button class="factures"><a href="list_factures.php">Accéder à la liste des factures</a></button>
<button class="factures"><a href="add_facture.php">Ajouter une facture</a></button>
<button class="factures"><a href="edit_facture.php">Modifier une facture</a></button>

<form method="GET">
    <input type="number" name="id_facture" placeholder="ID de la facture à supprimer">
    <button type="submit">Supprimer</button>
</form>



</body>
</html>