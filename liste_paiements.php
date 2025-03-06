
<?php
include'admin_check.php';
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    echo "❌ Accès refusé. Seuls les administrateurs peuvent voir cette page.";
    exit;
}
?>

<?php include 'config.php'; 

// Récupérer la liste des paiements avec les infos du billet associé 
$sql = "SELECT p.id, b.type AS type_billet, p.montant, p.methode, p.date_paiement 
FROM paiement p 
JOIN billet b ON p.billet_id = b.id 
ORDER BY p.date_paiement DESC"; 
$stmt = $pdo->query($sql); 
$paiements = $stmt->fetchAll(); 
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
<h2>Liste des paiements</h2> 

<table border="1"> 
    <tr> 
        <th>ID</th> 
        <th>Type de billet</th> 
        <th>Montant</th> 
        <th>Méthode</th> 
        <th>Date</th> 
        <th>Actions</th> 
    </tr> 
    <?php foreach ($paiements as $p) : ?> 
        <tr> 
            <td><?= $p['id'] ?></td> 
            <td><?= $p['type_billet'] ?></td> 
            <td><?= number_format($p['montant'], 2) ?> €</td> 
            <td><?= $p['methode'] ?></td> 
            <td><?= $p['date_paiement'] ?></td> 
            <td> 
                <a href="modifier_paiement.php?id=<?= $p['id'] ?>">Modifier</a> | 
                <a href="supprimer_paiement.php?id=<?= $p['id'] ?>" onclick="return confirm('Supprimer ce paiement ?')">Supprimer</a> 
            </td> 
        </tr> 
        <?php endforeach; ?> 
    </table> 
    <a href="ajouter_paiement.php">Ajouter un paiement</a>