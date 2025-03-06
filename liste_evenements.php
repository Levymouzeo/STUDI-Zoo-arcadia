<?php
include 'config.php';

// Récupérer la liste des événements
$sql = "SELECT * FROM evenements ORDER BY date_event ASC";
$stmt = $pdo->query($sql);
$evenements = $stmt->fetchAll();
?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
<h2>Liste des événements 🎪</h2>
<table border="1">
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Date</th>
        <th>Heure</th>
        <th>Lieu</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($evenements as $e) : ?>
        <tr>
            <td><?= htmlspecialchars($e['nom']) ?></td>
            <td><?= htmlspecialchars($e['description']) ?></td>
            <td><?= htmlspecialchars($e['date_event']) ?></td>
            <td><?= htmlspecialchars($e['heure']) ?></td>
            <td><?= htmlspecialchars($e['lieu']) ?></td>
            <td>
                <a href="modifier_evenements.php?id=<?= $e['id'] ?>">Modifier</a> |
                <a href="supprimer_evenements.php?id=<?= $e['id'] ?>" onclick="return confirm('Supprimer cet événement ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="ajouter_evenement.php">➕ Ajouter un événement</a>
