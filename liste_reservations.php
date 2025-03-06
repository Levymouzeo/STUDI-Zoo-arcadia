<?php
session_start();
if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'admin' && $_SESSION['user_role'] !== 'employe')) {
    echo "❌ Accès refusé. Seuls les employés et administrateurs peuvent voir cette page.";
    exit;
}
?>



<?php
include 'config.php';

// Récupérer toutes les réservations avec les infos des visiteurs et des billets
$sql = "SELECT r.id, v.nom AS visiteur_nom, v.prenom AS visiteur_prenom, 
               b.type AS type_billet, b.prix, r.date_reservation 
        FROM reservation r
        JOIN visiteur v ON r.visiteur_id = v.id
        JOIN billet b ON r.billet_id = b.id";
$stmt = $pdo->query($sql);
$reservations = $stmt->fetchAll();
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
        background-color: #f5f5f5;
    }
</style>
<h2>Liste des Réservations</h2>

<table border="1">
    <tr>    
        <th>ID</th>
        <th>Visiteur</th>
        <th>Billet</th>
        <th>Date de Réservation</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($reservations as $r) : ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= $r['visiteur_nom'] . ' ' . $r['visiteur_prenom'] ?></td>  <!-- Correction ici -->
            <td><?= $r['type_billet'] ?> (<?= $r['prix'] ?> €)</td> <!-- Correction ici -->
            <td><?= $r['date_reservation'] ?></td>
            <td>
                <a href="modifier_reservation.php?id=<?= $r['id'] ?>">Modifier</a> |
                <a href="supprimer_reservation.php?id=<?= $r['id'] ?>" onclick="return confirm('Supprimer cette réservation ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="ajouter_reservation.php">Ajouter une réservation</a>
