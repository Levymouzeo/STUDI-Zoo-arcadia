<?php
include 'config.php'; // Connexion à la base de données

// Récupérer la liste des tâches avec le nom des employés
$sql = "SELECT tache.id, tache.description, tache.date_tache, employe.nom, employe.prenom 
        FROM tache 
        JOIN employe ON tache.employe_id = employe.id";
$stmt = $pdo->query($sql);
$taches = $stmt->fetchAll();
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
<h2>Liste des Tâches</h2>
<table border="1">
    <tr>
        <th>Description</th>
        <th>Date</th>
        <th>Employé</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($taches as $t) : ?>
        <tr>
            <td><?= htmlspecialchars($t['description']) ?></td>
            <td><?= htmlspecialchars($t['date_tache']) ?></td>
            <td><?= htmlspecialchars($t['nom'] . ' ' . $t['prenom']) ?></td>
            <td>
                <a href="modifier_tache.php?id=<?= $t['id'] ?>">✏️ Modifier</a>
                <a href="supprimer_tache.php?id=<?= $t['id'] ?>" onclick="return confirm('Confirmer la suppression ?')">❌ Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
