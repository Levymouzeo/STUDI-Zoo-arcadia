<?php
session_start();
if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'admin' && $_SESSION['user_role'] !== 'employe')) {
    echo "❌ Accès refusé. Seuls les employés et administrateurs peuvent voir cette page.";
    exit;
}
?>


<?php
include 'config.php';

$sql = "SELECT * FROM animal";
$stmt = $pdo->query($sql);
$animaux = $stmt->fetchAll();
?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>
<h2>Liste des animaux 🦁🐼🐘</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Race</th>
        <th>Image</th>
        <th>Habitat ID</th>
        <th>Etat</th>
        <th>Nourriture</th>
        <th>Grammage</th>
        <th>Date de la dernière visite</th>
    </tr>
    <?php foreach ($animaux as $animal): ?>
        <tr>
            <td><?= $animal['id'] ?></td>
            <td><?= $animal['nom'] ?></td>
            <td><?= $animal['race'] ?></td>
            <td><?= $animal['image'] ?></td>
            <td><?= $animal['habitat_id'] ?></td>
            <td><?= $animal['etat'] ?></td>
            <td><?= $animal['nourriture'] ?></td>
            <td><?= $animal['grammage'] ?></td>
            <td><?= $animal['date_derniere_visite'] ?></td>
        </tr>
        <td><a href="modifier_animal.php?id=<?= $animal['id'] ?>">Modifier</a></td>
        <td><a href="supprimer_animal.php?id=<?= $animal['id'] ?>">Supprimer</a></td>
    <?php endforeach; ?>
</table>
