<?php
include 'config.php';

// Récupérer les repas avec les noms des animaux
$sql = "SELECT r.id, a.nom AS animal, r.type_nourriture, r.quantite, r.date_repas
        FROM repas r
        JOIN animal a ON r.animal_id = a.id
        ORDER BY r.date_repas DESC";
$stmt = $pdo->query($sql);
$repas = $stmt->fetchAll();
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
</style>
<!-- Affichage des repas -->
<h2>Liste des repas des animaux 🍽️</h2>
<table border="1">
    <tr>
        <th>Animal</th>
        <th>Type de nourriture</th>
        <th>Quantité (g)</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($repas as $r) : ?>
        <tr>
            <td><?= htmlspecialchars($r['animal']) ?></td>
            <td><?= htmlspecialchars($r['type_nourriture']) ?></td>
            <td><?= htmlspecialchars($r['quantite']) ?></td>
            <td><?= htmlspecialchars($r['date_repas']) ?></td>
            <td>
                <a href="modifier_repas.php?id=<?= $r['id'] ?>">Modifier</a> |
                <a href="supprimer_repas.php?id=<?= $r['id'] ?>" onclick="return confirm('Supprimer ce repas ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="ajouter_repas.php">➕ Ajouter un repas</a>
