<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des factures</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<?php
require_once "config/db.php";
global $bdd;

$sql = "SELECT * FROM factures";
$query = $bdd->query($sql);
$factures = $query->fetchAll();

$sql_clients = "SELECT * FROM clients";
$query_clients = $bdd->query($sql_clients);
$clients = $query_clients->fetchAll();
$classe = "visible";

foreach ($clients as $client) {
    $date_naissance = $client['date_naissance'];
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
    <th hidden>Boutons</th>
</tr>"; if (isset($_GET['id_facture']))
    echo "<tbody>";
    foreach ($factures as $facture) { ?>
    <tr class="<?php if(empty($date_debut) && $date_naissance < $date_debut) echo "hidden"    ?>">
        <td><?php echo $facture['id_facture']; ?></td>
        <td><?php echo $facture['montant']; ?></td>
        <td><?php echo $facture['produits']; ?></td>
        <td><?php echo $facture['quantite']; ?></td>
        <td><?php echo $facture['id_client']; ?></td>
        <?php foreach ($clients as $client) {
            if ($facture['id_client'] == $client['id_client']) {
                echo    '<td>' . $client['nom'] . '</td>' .
                        '<td>' . $client['date_naissance'] . '</td>';
                if ($client['date_naissance'] > date("2025-11-11")) {
                    echo '<td>' . $client['date_naissance'] . '</td>';
                }
            }
            } ?></html>
<?php }
"
<label for='date_debut'>Date de début</label>
<input type='date' name='date_debut' placeholder='Du'>
<label for='date_fin'>Date de fin</label>
<input type='date' name='date_fin' placeholder='Au'>
</table>";
    echo "<button><a href='edit_facture.php'>Modifier une facture</a></button>
<button><a href='delete_facture.php'>Supprimer une facture</a></button>"
    ?>
    <?php


}
else {echo "<p class='erreur'>Aucune facture trouvée dans la base de données</p>";}
?>



<body>

</body>
</html>