<?php
global $bdd;
require_once "config/db.php";


$sql = "SELECT * FROM clients";
$query = $bdd->query($sql);
$clients = $query->fetchAll();
?>
<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des clients</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<h1>
    Bienvenue sur la page de gestions des factures
</h1>
<h2>
    Voici la liste de tous les clients
</h2>
<button><a href="index.php">Accueil</a></button><br><br>
<button class ="clients"><a href="add_client.php">Ajouter un nouveau client</a></button><br><br>
<table>
    <tr>
        <th class="court">ID</th>
        <th class="long">Nom</th>
        <th class="long">Prénom</th>
        <th class="court">Sexe</th>
        <th class="long">Date de naissance</th>
    </tr>
    <tbody>
        <?php
        foreach($clients as $client){ ?>
            <tr>
            <td><?php echo $client['id_client'];?></td>
            <td><?php echo $client['nom'];?></td>
            <td><?php echo $client['prenom'];?></td>
            <td><?php echo $client['sexe'];?></td>
            <td><?php echo $client['date_naissance'];?></td>
         <?php } ?>

    </tbody>
</table>
</body>
</html>
