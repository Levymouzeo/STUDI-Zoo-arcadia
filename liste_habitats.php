<?php
include 'config.php';

$sql = "SELECT * FROM habitat";
$stmt = $pdo->query($sql);
$enclos = $stmt->fetchAll();
?>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
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
        background-color: #f2f2f2;
    }
</style>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Image</th>
    </tr>
    <?php foreach ($enclos as $e) : ?>
    <tr>
        <td><?= $e['id'] ?></td>
        <td><?= $e['nom'] ?></td>
        <td><?= $e['description'] ?></td>
        <td><?= $e['image'] ?></td>
        <td>
            <a href="modifier_habitats.php?id=<?= $e['id'] ?>">Modifier</a> | 
            <a href="supprimer_habitats.php?id=<?= $e['id'] ?>" onclick="return confirm('⚠️ Voulez-vous vraiment supprimer cet habitat ?')">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
