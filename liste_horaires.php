<?php
include 'config.php';

$sql = "SELECT h.id, e.nom, h.jour, h.heure_debut, h.heure_fin 
        FROM horaire h 
        JOIN employe e ON h.employe_id = e.id";
$stmt = $pdo->query($sql);
$horaires = $stmt->fetchAll();
?>
<style>
    table {
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 5px;
    }
</style>
<table border="1">
    <tr>
        <th>Employé</th>
        <th>Jour</th>
        <th>Heure de début</th>
        <th>Heure de fin</th>
        <th>Action</th>
    </tr>
    <?php foreach ($horaires as $h) : ?>
        <tr>
            <td><?= $h['nom'] ?></td>
            <td><?= $h['jour'] ?></td>
            <td><?= $h['heure_debut'] ?></td>
            <td><?= $h['heure_fin'] ?></td>
            <td>
                <a href="modifier_horaire.php?id=<?= $h['id'] ?>">Modifier</a> |
                <a href="supprimer_horaire.php?id=<?= $h['id'] ?>" onclick="return confirm('Supprimer cet horaire ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
