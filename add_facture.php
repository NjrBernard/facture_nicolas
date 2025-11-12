<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter une facture</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<h1>
    Bienvenue sur la page de gestions des factures
</h1>
<h2>
    Insertion d'une nouvelle facture
</h2>
<button><a href="index.php">Accueil</a></button><br><br>
<button class="factures"><a href="list_factures.php">Accéder à la liste des factures</a></button>
<button class="factures"><a href="edit_facture.php">Modifier une facture</a></button>
<button class="factures"><a href="delete_facture.php">Supprimer une facture</a></button><br>
<?php
require_once "config/db.php";
global $bdd;

$sql_client = "SELECT * FROM clients";
$select = $bdd->query($sql_client);
$clients = $select->fetchAll();

if (isset($_POST['montant']) && isset($_POST['produits']) && isset($_POST['quantite']) && isset($_POST['id_client'])) {
    $montant = $_POST['montant'];
    $produits = $_POST['produits'];
    $quantite = $_POST['quantite'];
    $id_client = $_POST['id_client'];

    $sql = "INSERT INTO factures (montant, produits, quantite, id_client) VALUES (:montant, :produits, :quantite, :id_client)";
    $insert = $bdd->prepare($sql);
    $factures = $insert->execute([
            'montant' => $montant,
            'produits' => $produits,
            'quantite' => $quantite,
            'id_client' => $id_client,
    ]);
}
?>
<body>
<form method="post" action="add_facture.php">
    <label for="montant">Montant: </label><input type="number" name="montant"><br>
    <label for="produits">Produits: </label><input type="text" name="produits"><br>
    <label for="quantite">Quantité: </label><input type="number" name="quantite"><br>
        <select name="id_client" id="id_client">
            <option value="0">Sélectionnez un client</option>
            <?php foreach ($clients as $client) {?>
            <option value="<?php echo $client['id_client']?>"><?php echo $client['id_client'] . ' - ' . $client['nom'] . ' '  . $client['prenom']?></option>
            <?php } ?>
        </select><br>
    <button type="submit" name="envoyer">Envoyer</button>
</form>
</body>
</html>