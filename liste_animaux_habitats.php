<?php
include 'config.php';

$sql = "SELECT animal.id, animal.nom, animal.race, habitat.nom AS habitat
        FROM animal 
        LEFT JOIN habitat ON animal.habitat_id = habitat.id";
$stmt = $pdo->query($sql);
$animaux = $stmt->fetchAll();
?>
<style>
    table {
        border-collapse: collapse;
    }

    th, td {
        padding: 5px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Race</th>
        <th>Habitat</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($animaux as $a) : ?>
    <tr>
        <td><?= $a['id'] ?></td>
        <td><?= $a['nom'] ?></td>
        <td><?= $a['race'] ?></td>
        <td><?= $a['habitat'] ?? 'Non affecté' ?></td>
        <td>
            <a href="retirer_animal_habitat.php?id=<?= $a['id'] ?>">Retirer de l'habitat</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
