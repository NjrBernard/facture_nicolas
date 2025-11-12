<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des factures</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
    <body>
    <h1>
        Bienvenue sur la page de gestions des factures
    </h1>
    <h2>
        Voici la liste des factures existantes
    </h2>
    <button><a href="index.php">Accueil</a></button><br><br>
    <button class="factures"><a href="add_facture.php">Ajouter une facture</a></button>
    <button class="factures"><a href="edit_facture.php">Modifier une facture</a></button>
    <button class="factures"><a href="delete_facture.php">Supprimer une facture</a></button><br>
    <form method="get">
    <label for='date_debut'>Date de début</label>
    <input type='date' name='date_debut' placeholder='Du' value="<?php if (!empty($_GET['date_debut'])) echo $_GET['date_debut']; ?>">
    <label for='date_fin'>Date de fin</label>
    <input type='date' name='date_fin' placeholder='Au' value="<?php if (!empty($_GET['date_fin'])) echo $_GET['date_fin']; ?>">
    <button type="submit">Filtrer</button>
    </form>
<?php
require_once "config/db.php";
global $bdd;

$sql = "SELECT * FROM factures";
$query = $bdd->query($sql);
$factures = $query->fetchAll();

$sql_clients = "SELECT * FROM clients";
$query_clients = $bdd->query($sql_clients);
$clients = $query_clients->fetchAll();

if (isset($_GET['date_debut'])) {
    $date_debut = $_GET['date_debut'];
} else {
    $date_debut = null;
}

if (isset($_GET['date_fin'])) {
    $date_fin = $_GET['date_fin'];
} else {
    $date_fin = null;
}

if (!empty($factures)) {
    echo
    "<table>
    <tr>
    <th>ID Facture</th>
    <th>Montant</th>
    <th>Produits</th>
    <th>Quantité</th>
    <th>ID Client</th>
    <th>Nom du client</th>
    <th hidden>Date de naissance client</th>
</tr>"; if (isset($_GET['id_facture']))  echo "<tbody>";
    foreach ($factures as $facture) {
        foreach ($clients as $client) {
            if ($facture['id_client'] == $client['id_client']) {
                $date_naissance = $client['date_naissance'];break;
            }
        }
        ?>
        <tr class="<?php
        if (
                (!empty($_GET['date_debut']) && strtotime($date_naissance) < strtotime($_GET['date_debut'])) ||
                (!empty($_GET['date_fin']) && strtotime($date_naissance) > strtotime($_GET['date_fin']))
        ) {
            echo 'hidden';
        } else {
            echo 'visible';
        }
        ?>">
        <td class="court"><?php echo $facture['id_facture']; ?></td>
        <td class="court"><?php echo $facture['montant']; ?></td>
        <td class="long"><?php echo $facture['produits']; ?></td>
        <td class="court"><?php echo $facture['quantite']; ?></td>
        <td class="court"><?php echo $facture['id_client']; ?></td>
        <td class="long"><?php foreach ($clients as $client) {
            if ($facture['id_client'] == $client['id_client']) {
                echo $client['nom'] . " ". $client['prenom'];break;
            }
            } ?></td><td hidden><?php echo $client['date_naissance'] ?></td></tr>
<?php }
"</table>";

    ?>
    <?php


}
else {echo "<p class='erreur'>Aucune facture trouvée dans la base de données</p>";}
?>

</body>
</html>