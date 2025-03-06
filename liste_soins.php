<?php
session_start();
if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'admin' && $_SESSION['user_role'] !== 'employe')) {
    echo "❌ Accès refusé. Seuls les employés et administrateurs peuvent voir cette page.";
    exit;
}
?>


<?php
include 'config.php';

// Récupérer les soins avec les informations des animaux et des employés
$sql = "SELECT s.id, a.nom AS animal, e.nom AS employe, s.description, s.date_soin
        FROM soins s
        JOIN animal a ON s.animal_id = a.id
        LEFT JOIN employe e ON s.employe_id = e.id";
$stmt = $pdo->query($sql);
$soins = $stmt->fetchAll();
?>

<h2>Liste des soins</h2>
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
        <th>Animal</th>
        <th>Employé</th>
        <th>Description</th>
        <th>Date du soin</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($soins as $soin) : ?>
        <tr>
            <td><?= htmlspecialchars($soin['animal']) ?></td>
            <td><?= $soin['employe'] ? htmlspecialchars($soin['employe']) : 'Non assigné' ?></td>
            <td><?= htmlspecialchars($soin['description']) ?></td>
            <td><?= htmlspecialchars($soin['date_soin']) ?></td>
            <td>
                <a href="modifier_soin.php?id=<?= $soin['id'] ?>">Modifier</a> |
                <a href="supprimer_soin.php?id=<?= $soin['id'] ?>" onclick="return confirm('Supprimer ce soin ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="ajouter_soin.php">➕ Ajouter un soin</a>
