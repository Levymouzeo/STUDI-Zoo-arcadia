<?php
include 'config.php';

// Récupérer les stocks de nourriture
$sql = "SELECT * FROM stock_nourriture ORDER BY date_reception DESC";
$stmt = $pdo->query($sql);
$stocks = $stmt->fetchAll();
?>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
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
<!-- Liste des stocks -->
<h2>Stock de nourriture 📊</h2>
<table border="1">
    <tr>
        <th>Type de nourriture</th>
        <th>Quantité (kg)</th>
        <th>Date de réception</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($stocks as $s) : ?>
        <tr>
            <td><?= htmlspecialchars($s['type_nourriture']) ?></td>
            <td><?= htmlspecialchars($s['quantite']) ?></td>
            <td><?= htmlspecialchars($s['date_reception']) ?></td>
            <td>
                <a href="modifier_stock.php?id=<?= $s['id'] ?>">Modifier</a> |
                <a href="supprimer_stock.php?id=<?= $s['id'] ?>" onclick="return confirm('Supprimer ce stock ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="ajouter_stock.php">➕ Ajouter du stock</a>
