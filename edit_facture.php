<?php
require_once "config/db.php";
global $bdd;


require_once "config/db.php";
global $bdd;

if (isset($_POST['montant']) && isset($_POST['id_facture']) && isset($_POST['quantite']) & isset($_POST['produits'])) {
    $montant = $_POST['montant'];
    $id_facture = $_POST['id_facture'];
    $quantite = $_POST['quantite'];
    $produits = $_POST['produits'];
    $id_client = $_POST['id_client'];


    $sql = "UPDATE factures SET montant = :montant, produits = :produits, quantite = :quantite, id_client = :id_client WHERE id_facture = :id_facture";
    $update = $bdd->prepare($sql);
    $verif = $update->execute([
            'montant' => $montant,
            'produits' => $produits,
            'quantite' => $quantite,
            'id_facture' => $id_facture,
            'id_client' => $id_client,
    ]);
}


if (isset($_GET['id_facture'])) {
    $id_facture = $_GET['id_facture'];
    $query = $bdd->prepare("SELECT * FROM factures WHERE id_facture = :id_facture");
    $facture_a_modifier = $query->execute([
            'id_facture' => $id_facture
            ]);
    $facture_a_modifier = $query->fetch();
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
    Modification d'une facture
</h2>
<button><a href="index.php">Accueil</a></button><br><br>
<button class="factures"><a href="list_factures.php">Accéder à la liste des factures</a></button>
<button class="factures"><a href="add_facture.php">Ajouter une facture</a></button>
<button class="factures"><a href="delete_facture.php">Supprimer une facture</a></button><br>
<form method="GET">
    <input type="number" name="id_facture" placeholder="ID de la facture">
    <button type="submit">Rechercher</button>
</form>

<?php if (!empty($facture_a_modifier)) { ?>
<form method="POST">
    <input type="hidden" name="id_facture" value="<?= $facture_a_modifier['id_facture'] ?>">
    <label for="montant">Montant<input type="number" name="montant" value="<?= $facture_a_modifier['montant'] ?>"><br>
    <label for="produits">Produits</label><input type="text" name="produits" value="<?= $facture_a_modifier['produits'] ?>"><br>
        <label for="quantite">Quantité</label><input type="number" name="quantite" value="<?= $facture_a_modifier['quantite'] ?>"><br>
        <label for="id_client">Client</label><select name="id_client" id="id_client">
        <?php foreach ($clients as $client) {?>
            <option value="<?php echo $client['id_client']?>" <?php if ($client['id_client'] === $facture_a_modifier['id_client']) echo 'selected'?>><?php echo $client['id_client'] . ' - ' . $client['nom'] . ' '  . $client['prenom'] . " " . $facture_a_modifier['id_client']?></option>
        <?php } ?>
    </select><br>
    <button type="submit">Enregistrer</button>
</form>
<?php } ?>

</body>
</html>