<?php
include 'config.php';

// Récupérer tous les habitats
$sql = "SELECT * FROM habitat";
$stmt = $pdo->query($sql);
$habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Animaux par habitat</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { background-color: #f2f2f2; padding: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 8px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <h1>Animaux par habitat</h1>
    <?php foreach ($habitats as $habitat): ?>
        <h2><?= htmlspecialchars($habitat['nom']) ?> (<?= htmlspecialchars($habitat['description']) ?>)</h2>
        <?php
        // Récupérer les animaux pour cet habitat
        $sqlAnimaux = "SELECT * FROM animal WHERE habitat_id = ?";
        $stmtAnimaux = $pdo->prepare($sqlAnimaux);
        $stmtAnimaux->execute([$habitat['id']]);
        $animaux = $stmtAnimaux->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php if (count($animaux) > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Race</th>
                    <th>Image</th>
                    <th>Habitat_ID</th>
                    <th>Etat</th>
                    <th>Nourriture</th>
                    <th>Grammage</th>
                    <th>Date de la dernière visite</th>
                </tr>
                </tr>
                <?php foreach ($animaux as $animal): ?>
                    <tr>
                        <td><?= htmlspecialchars($animal['id']) ?></td>
                        <td><?= htmlspecialchars($animal['nom']) ?></td>
                        <td><?= htmlspecialchars($animal['race']) ?></td>
                        <td><?= htmlspecialchars($animal['image']) ?></td>
                        <td><?= htmlspecialchars($animal['habitat_id']) ?></td>
                        <td><?= htmlspecialchars($animal['etat']) ?></td>
                        <td><?= htmlspecialchars($animal['nourriture']) ?></td>
                        <td><?= htmlspecialchars($animal['grammage']) ?></td>
                        <td><?= htmlspecialchars($animal['date_derniere_visite']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Aucun animal affecté dans cet habitat.</p>
        <?php endif; ?>
    <?php endforeach; ?>
</body>
</html>
