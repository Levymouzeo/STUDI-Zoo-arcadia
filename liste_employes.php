<?php
include 'config.php'; // Connexion à la base de données

// Récupérer la liste des employés
$sql = "SELECT * FROM employe ORDER BY id ASC";
$stmt = $pdo->query($sql);
$employes = $stmt->fetchAll();
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
<h2>📋 Liste des Employés</h2>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Poste</th>
            <th>Téléphone</th>
            <th>Département</th>
            <th>Date d'embauche</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Salaire (€)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employes as $employe) : ?>
            <tr>
                <td><?= $employe['id'] ?></td>
                <td><?= htmlspecialchars($employe['nom']) ?></td>
                <td><?= htmlspecialchars($employe['prenom']) ?></td>
                <td><?= htmlspecialchars($employe['date_naissance']) ?></td>
                <td><?= htmlspecialchars($employe['poste']) ?></td>
                <td><?= htmlspecialchars($employe['telephone']) ?></td>
                <td><?= htmlspecialchars($employe['departement']) ?></td>
                <td><?= htmlspecialchars($employe['date_embauche']) ?></td>
                <td><?= htmlspecialchars($employe['email']) ?></td>
                <td><?= htmlspecialchars($employe['adresse']) ?></td>
                <td><?= htmlspecialchars($employe['salaire']) ?></td>
                <td>
                    <a href="modifier_employe.php?id=<?= $employe['id'] ?>">✏️ Modifier</a> | 
                    <a href="supprimer_employe.php?id=<?= $employe['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?')">🗑️ Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="ajouter_employes.php">➕ Ajouter un employé</a>
