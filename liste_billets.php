<?php include 'config.php'; 

// Récupérer la liste des billets avec les infos des visiteurs 
$sql = "SELECT b.id, v.nom, v.prenom, b.type, b.prix, b.date_achat 
FROM billet b 
JOIN visiteur v ON b.visiteur_id = v.id 
ORDER BY b.date_achat DESC"; 

$stmt = $pdo->query($sql); 
$billets = $stmt->fetchAll(); 
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
<h2>Liste des Billets 🎟️</h2> 

<table border="1"> 
    <tr> 
        <th>ID</th> 
        <th>Visiteur</th> 
        <th>Type</th> 
        <th>Prix (€)</th> 
        <th>Date d'achat</th> 
        <th>Actions</th> </tr> 
        <?php foreach ($billets as $b) : ?> 
            <tr> 
                <td><?= $b['id'] ?></td> 
                <td><?= $b['nom'] . ' ' . $b['prenom'] ?></td> 
                <td><?= $b['type'] ?></td> 
                <td><?= $b['prix'] ?></td> 
                <td><?= $b['date_achat'] ?></td> 
                <td> 
                    <a href="modifier_billet.php?id=<?= $b['id'] ?>">✏ Modifier</a> | 
                    <a href="supprimer_billet.php?id=<?= $b['id'] ?>" onclick="return confirm('Supprimer ce billet ?')">🗑 Supprimer</a> 
                </td> 
            </tr> 
            <?php endforeach; ?> 
        </table>